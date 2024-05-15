<script>
    var currentUserkey = '';
    var chatKey = '';
    var friend = '';
    var chatrom = '';
    function startchat(friendKey, friendName, FriendPhoto, FriendStatus)
    {
      var friendList = {friendId: friendKey, userId: currentUserkey};
      friend_id = friendKey;
      var db = firebase.database().ref('friend_list');
      var flag = false;
      db.on('value', function(friends) {
          friends.forEach(function(data) {
              var user = data.val();
              if ((user.friendId === friendList.friendId && user.userId === friendList.userId) || ((user.friendId === friendList.userId && user.userId === friendList.friendId))) {
                  chatKey = data.key;
                  flag = true;
              }
          });
          if (flag === false) {
              chatKey = firebase.database().ref('friend_list').push(friendList, function(error){
                  if (error) {
                      alert(error);
                  }else{
                      document.getElementById('chatpanel').removeAttribute('style');
                      document.getElementById('divstart').removeAttribute('style','display:none');
                      document.getElementById('side-1').classList.add('chats-mobile');
                      {{-- hidechatlist(); --}}
                  }
              }).getKey();
          }else{
              // display
              document.getElementById('chatpanel').removeAttribute('style');
              document.getElementById('divstart').style.display = "none";
              document.getElementById('side-1').classList.add('chats-mobile');
              {{-- hidechatlist(); --}}

          }
          document.getElementById('divChatName').innerHTML =friendName;
          document.getElementById('imgChat').src =FriendPhoto;
          document.getElementById('divChatSeen').innerHTML = FriendStatus;

          document.getElementById('message').innerHTML = '';
          send();
          document.getElementById('txmessage').value = '';
          document.getElementById('txmessage').focus();
          loadchatMeseges(chatKey,FriendPhoto);
      });
    }
    function changeiconsend(control)
    {
        if(control.value !== ''){
            document.getElementById('sendaudio').removeAttribute('style');
            document.getElementById('audio').setAttribute('style','display:none');
        }else{
            document.getElementById('audio').removeAttribute('style');
            document.getElementById('sendaudio').setAttribute('style','display:none');
        }
    }
    
    function loadAllEmoji()
    {
        var emoji = '';
        for(var i = 128512; i<=128536; i++){
            emoji += `<a href="javascript:void(0)" style="font-size:24px; color: black;" onclick="getEmoji(this)">&#${i};</a>`;
        }
        document.getElementById('smileContent').innerHTML = emoji;
    }

    function showEmoji()
    {
        document.getElementById('emoji').removeAttribute('style');
    }
    function hideEmoji()
    {
        document.getElementById('emoji').setAttribute('style','display:none');
    }
    function getEmoji(control)
    {
        document.getElementById('txmessage').value += control.innerHTML
    }
    function loadchatMeseges(chatKey,FriendPhoto)
    {
        var db = firebase.database().ref('chatMessages').child(chatKey);
        db.on('value',function(chats){
            var messageDisplay = '';
            chats.forEach(function(data){
                chatrom = data.key;
                var message = data.val();
                var dateTime = message.dateTime.split(",");
                var msg = '';
                if(message.msg.indexOf("base64") !== -1){
                    msg = `<img src='${message.msg}' style="width:100px; height:100px" />`;
                }else if(message.msg.indexOf("blob") !== -1){
                    msg = `<audio controls> 
                            <source src="${message.msg}" type="video/webm"/> 
                           </audio>`;
                }else{
                    msg = message.msg;
                }
                firebase.database().ref('friend_list').child(message.userId);
                if (message.userId !== currentUserkey) {
                    messageDisplay += `<div class="rows">
                    <div class="col-2 col-sm-1 col-md-1">
                        <img src="${FriendPhoto}" class="chat-pic rounded-circle" alt="" srcset="">
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                        <p class="recive">${msg}
                        <span class="time float-right" title="${dateTime[0]}">${dateTime[1]}</span>
                        </p>
                    </div>
                </div>`;
                }else{
                    messageDisplay += `<div class="rows justify-content-end">
                        <div class="col-6 col-sm-6 col-md-6">
                            <p class="sent float-right">
                            ${msg}
                                <span class="time float-right" title="${dateTime[0]}">${dateTime[1]}</span>
                            </p>
                        </div>
                        <div class="col-2 col-sm-1 col-md-1">
                            <img src="{{ asset('img/user.png') }}" class="chat-pic rounded-circle" alt="" srcset="">
                        </div>
                    </div>`;
                }
            });
            document.getElementById('message').innerHTML = messageDisplay;
            document.getElementById('message').scrollTo(0, document.getElementById('message').clientHeight);
        });
    }
    function hidechatlist()
    {
        window.location.href = "{{ url('/') }}";
        document.getElementById('side-1').classList.add('d-none','d-md-block');
        document.getElementById('side-2').classList.remove('d-none');
    }
    function send()
    {
        document.addEventListener('keydown', function(key){
            if (key.which === 13) {
                sendmessage();
            }
        });
    }
    function sendmessage()
    {
      var chatMessage = {
          userId: currentUserkey,
          msg: document.getElementById('txmessage').value,
          dateTime: new Date().toLocaleString()
      };
      firebase.database().ref('chatMessages').child(chatKey).push(chatMessage, function(error) {
        if(error){
          console.log(error);
        }else{
        firebase.database().ref('fcmTokens').child(friend_id).once('value').then(function(data){
            $.ajax({
                url: 'https://fcm.googleapis.com/fcm/send',
                method: 'POST',
                headers:{
                    'Content-Type': 'application/json',
                    'Authorization': 'key=AAAA7ZHni2A:APA91bH0URz7A6eCqjzFOTf5mLYe_npzrwFGHDve7_VDPIQ4Fd7CwllysyJdyfRWBeM3X6Zt3x7-z4mga4-V3h_9sJDT9tGWoM7ADP7iVT9wC8gp2YLDp3P1bsSgTAn1XbPpagZGF2hl'
                },
                data: JSON.stringify({yyy
                    'to': data.val().token_id, 'data': {'message': chatMessage.msg.substring(0,30)}
                }),
                success: function(xhr, status,error){
                    console.log(xhr.error);
                }
            });
        });
          document.getElementById('txmessage').value = '';
          document.getElementById('txmessage').focus();
        }
      });
    }
    function choseImage()
    {
        document.getElementById('imageFile').click();
    }
    function sendImage(event)
    {
        var file = event.files[0];

        if(!file.type.match("image.*")){
            alert("silahkan Masukan File Image");
        }else{
            var reader = new FileReader();

            reader.addEventListener("load",function(){
                var chatMessage = {
                    userId: currentUserkey,
                    msg: reader.result,
                    dateTime: new Date().toLocaleString()
                };
                firebase.database().ref('chatMessages').child(chatKey).push(chatMessage, function(error) {
                  if(error){
                    console.log(error);
                  }else{
                      
                    document.getElementById('txmessage').value = '';
                    document.getElementById('txmessage').focus();
                  }
                });
            },false);
            if(file){
                reader.readAsDataURL(file);
            }
        }
    }
    function chatList()
    {
        var db = firebase.database().ref('friend_list');
        db.on('value', function(list){
            document.getElementById('listChat').innerHTML =  `<li class="list-group-item" style="background-color: #f8f8f8">
            <input type="text" placeholder="Search Nerw Chat" class="form-control form-rounded">
        </li>`;
            list.forEach(function(data){
                var li = data.val();
                var friendKey = '';
                if (li.friendId === currentUserkey) {
                    friendKey = li.userId;
                }
                else if (li.userId === currentUserkey) {
                    friendKey = li.friendId;
                }
                if (friendKey !== '') {
                    firebase.database().ref('users').child(friendKey).on('value',function(data){
                        var user = data.val();
                        document.getElementById('listChat').innerHTML += `<li class="list-group-item list-group-item-action" onclick="startchat('${data.key}','${user.name}','${user.photoURL}','${user.status}','${user.typing}')">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="${user.photoURL}" class="profile-pic rounded-circle" alt="" srcset="">
                            </div>
                            <div class="col-md-10" style="cursor: pointer">
                                <div class="name">${user.name}</div>
                                <div class="under-name">This is some mesage text ...</div>
                            </div>
                        </div>
                    </li>`;
                    });
                }
            });
        });
    }
    function populateFriendList()
    {
        document.getElementById('listFriend').innerHTML = ` <div class="text-center">
          <span class="fa fa-spinner text-primary" style="font-size:40px; margin-top: 12px;"></span>
      </div>`;
      var db = firebase.database().ref('users');
      db.on('value', function(users){
        if (users.hasChildren()) {
             list = `<li class="list-group-item" style="background-color: #f8f8f8">
            <input type="text" placeholder="Search Nerw Chat" class="form-control form-rounded">
        </li>`;
        }
        users.forEach(function(data){
            var user = data.val();
            if (user.email !== "{{ auth()->user()->email }}") {
                list +=  `<li class="list-group-item list-group-item-action" data-dismiss="modal" onclick="startchat('${data.key}', '${user.name}', '${user.photoURL}','${user.status}')">
                <div class="rows">
                    <div class="col-md-2">
                        <img src="${user.photoURL}" class="profile-pic rounded-circle" alt="" srcset="">
                    </div>
                    <div class="col-md-10" style="cursor: pointer; padding: 10px">
                        <div class="name" style="">${user.name}</div>
                    </div>
                </div>
            </li>`;

            }
        });
        document.getElementById('listFriend').innerHTML = list;
      });
    }
    function hitungPesan()
    {
        const teman = firebase.database().ref('friend_list');
        teman.on('value',function(datas){
            datas.forEach(function(temans){
                const temankey = temans.val();
                if((temankey.userId === currentUserkey) || ((temankey.friendId === currentUserkey))){
                   const keys = temans.key;
                   const db = firebase.database().ref('chatMessages').child(keys);
                    db.on('value',function(chats){
                        chats.forEach(function(data){
                            chatrom = data.key;
                            var message = data.val();
                            if (message.userId === currentUserkey) {
                                const count = chats.numChildren();
                                document.getElementById('notifchat').innerHTML = count + ' Pesan';
                            }else{
                                const count = chats.numChildren();
                                document.getElementById('notifchat').innerHTML = count + ' Pesan';
                            }
                        });
                    });
                }
            })
        });
    }
    function onStateChanged()
    {
      var userProfile = {email:'', name:'', photoURL:'',status:''};
      
      userProfile.email = "{{ auth()->user()->email }}";
      userProfile.name = "{{ auth()->user()->nama }}";
      userProfile.photoURL = "{{ asset('img/user.png') }}";
      var minute = new Date().toLocaleString();
      var db = firebase.database().ref('users');
      var flag = false;
      
      db.on('value',function(users){
        users.forEach(function(data){
          var user = data.val();
          if(user.email === userProfile.email){
            currentUserkey = data.key;
            firebase.database().ref('users/' + currentUserkey).update({
                "status": minute
            });
            flag = true;
          }
        });
        if(flag === false){
          firebase.database().ref('users').push(userProfile);
        }else{
          document.getElementById('imgProfile').src = "{{ asset('img/user.png') }}";
          document.getElementById('imgProfile').title = "{{ auth()->user()->nama }}";
        }
        if(firebase.messaging.isSupported()){
            const messaging = firebase.messaging();
            messaging.requestPermission().then(function(){
                return messaging.getToken();
            }).then(function(token){
                firebase.database().ref('fcmTokens').child(currentUserkey).set({token_id: token});
            });

        }else{
            alert('Browser Anda Tidak Suport Notifikasi');
        }
        chatList();
        hitungPesan();
      });
    }
    
</script>