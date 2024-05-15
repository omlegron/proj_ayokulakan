<?php

namespace App\Http\Controllers\FrontEnd\Chat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Chat\ChatRoom;


use App\Models\User;
use App\Models\Barang\LapakBarang;
use App\Models\Rental\Rental;
use App\Models\Chat\Chat;
use App\Models\Chat\ChatDetail;
use App\Models\Lapak\Lapak;

use Zipper;
use Carbon\Carbon;

use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use File;

class ChatController extends Controller
{
    //
    protected $link = 'chat/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Chat Sekarang");
        $this->setGroup("Chat Sekarang");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Chat Sekarang' => '#']);
    }

    public function index(Request $request)
    {
        return $this->render('frontend.chat.index',[
            'user_id' => auth()->user()->id
        ]);
    }

    public function showList(Request $request){
        if ($request->_token) {
            $record = User::orderBy('created_at','desc')->select('*');
            $record = $record->paginate(50);
            return $this->render('frontend.chat.show-list',[
                'record' => $record
            ]);
        }else {
            return \abort(404);
        }
    }

    public function friendList(Request $request)
    {
        if($request->_token)
        {
            $record = Chat::with('user')->orderBy('created_at','desc')->get();
            return $this->render('frontend.chat.show-friend',[
                'record' => $record,
                'chat' => ChatRoom::select('*')
            ]);
        }else {
            return \abort(404);
        }

    }

    public function addFriend(Request $request)
    {
        $chat = Chat::select('*');
        $val = $chat->get();
        $flag = false;
        $chatkey = '';
        if ($chat != '') {
            foreach ($val as $key => $value) {
                if (($value->friend_id == $request->friend_id && $value->user_id == $request->user_id) || (($value->friend_id == $request->user_id && $value->user_id == $request->friend_id))) {
                    $chatkey = $value->id;
                    $status = ChatRoom::where([
                        'chat_id' => $chatkey,
                        'chat_to' => auth()->user()->id,
                        'type'    => 'chat'
                        ])->update(['status' => 'dibaca']);
                    $flag = true;
                }
            }
        }
        if ($flag === false) {
            $record = Chat::create([
                'user_id' => $request->user_id,
                'friend_id' => $request->friend_id,
            ]);
            $chatkey = $record->id;
        }
        $data = ChatRoom::where('chat_id',$chatkey)->where('type','chat')->select('*');
        $value = $data->get();
        return $this->render('frontend.chat.chat-room',[
            'message'       => $value,
            'trans_chat'    => $chatkey
        ]);
    }

    public function sendChat(Request $request){
        $record = Chat::find($request->key);
        if ($request->id_barang) {
            $record->chatFriend()->create([
                'chat_id'       => $request->key,
                'user_id'       => $request->user_id,
                'chat_to'       => $request->friend_id,
                'id_barang'     => $request->id_barang ?? ' ',
                'message'       => $request->message,
                'status'        => 'kirim',
                'type'          => 'chat',
                'waktu'         => Carbon::now(),
            ]);
        }else{
            $record->chatFriend()->create([
                'chat_id'       => $request->key,
                'user_id'       => $request->user_id,
                'chat_to'       => $request->friend_id,
                'message'       => $request->message,
                'status'        => 'kirim',
                'type'          => 'chat',
                'waktu'         => Carbon::now(),
            ]);
        }
        $data = ChatRoom::where('chat_id',$request->key)->where('type','chat')->select('*');
        $value = $data->get();
        return $this->render('frontend.chat.chat-room',[
            'message'       => $value,
            'trans_chat'    => $request->key
        ]);
    }

    public function loadChat(Request $request)
    {
        if ($request->key !== '') {
            $data = ChatRoom::where('chat_id',$request->key)->select('*');
        }else {
            $data = ChatRoom::where('chat_id',$chatkey)->select('*');
        }
        $value = $data->get();
        return $this->render('frontend.chat.chat-room',[
            'message'       => $value,
            'trans_chat'    => $request->key
        ]);
    }
    public function postNotif(Request $request){
        $record = Chat::find($request->id);
        $record->status = 2;
        $record->save();
    }

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }

    public function indexSewa(Request $request)
    {     
        // dd(auth()->user()->id);
        
        $cekChat = [];
        if(($request->toko_barang) && ($request->toko)){
            $cekLapakBarang = Rental::find($request->toko_barang);
            $data['form_id']=$request->toko_barang;
            $data['form_type']='img_rental';
            $data['id_lapak']=$request->toko;
            $data['id_user_chat_to']=$cekLapakBarang->created_by;
            $cekChat = Chat::where('created_by',auth()->user()->id)->where('id_lapak',$request->toko)->first();
            if(!$cekChat){
               $cekChat = Chat::create($data);
            }
        }

        $rec1 = Chat::with('lapak','form','lapak.creator','form.creator','lapak.attachment','creator','creator.pictureoneusers')->where('created_by',auth()->user()->id)->orWhere('id_user_chat_to',auth()->user()->id)->get();

        return $this->render('frontend.chat.index',[
            'request' => $request->all(),
            'cekChat' => $cekChat,
            'appendList' => $rec1,
            'user_id' => auth()->user()->id
        ]);
    }

    public function diskusi()
    {
        
        return $this->render('frontend.chat.diskusi');
    }
    public function sendDiskusi(Request $request)
    {
        $record = ChatRoom::create([
            'user_id'       => auth()->user()->id,
            'chat_to'       => $request->friend_id,
            'id_barang'     => $request->id_barang,
            'message'       => $request->message,
            'status'        => 'kirim',
            'type'          => 'diskusi',
            'waktu'         => Carbon::now(),
        ]);
        $data = ChatRoom::where('user_id',$record->user_id)->where('type','diskusi')->where('id_barang',$record->id_barang)->select('*');
        $value = $data->get();
        return $this->render('frontend.home.partial.diskusi',[
            'message'       => $value,
            'trans_chat'    => $record->id
        ]);
    }
    public function ulasan()
    {
        return $this->render('frontend.chat.ulasan');
    }
}
