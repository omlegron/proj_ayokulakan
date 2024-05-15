@extends('layouts.scaffold')
@section('js-filters')
d.nama = $("input[name='filter[name]']").val();
@endsection

@section('rules')
<script type="text/javascript">
    formRules = {
        judul: ['empty']
    , };

</script>
@endsection

@section('css')
<style>
    .outer-top {
        margin-top: 188px;
    }
    .terms-conditions-page{
        padding-top: 0px !important;
    }
    #canvas_container {
          width: 100%;
          height: 450px;
          overflow: scroll;
      }
 
      #canvas_container {
        text-align: center;
        border: solid 3px;
      }
      .card{
          border: 1px solid #000000;
          border-radius: 5px;
          margin: 10px 0px;
      }
      .card .card-body{
          padding: 20px;
      }
      .card .card-body .card-arab{
          text-align: end;
          font-size: 20px;
          font-weight: 300;
          border-bottom: 1px solid black;
          padding-bottom: 10px
      }
      .card .card-body .card-id{
        text-align: justify;
        font-size: 18px;

      }
      .card .card-header{
          height: 50px;
          background-color: #0db130;
          color: #ffffff;
          line-height: 50px;
          font-weight: bold;
          font-size: 24px;
          text-align: center;
      }

    @media only screen and (max-width: 768px) {
        .outer-top {
            margin-top: 387px;
        }
    }

</style>
@endsection

@section('content-frontend')
<div class="terms-conditions-page">
    <div class="body-content">
        <a href="{{ url('/') }}" style="font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left" style="padding: 20px"></i></a>
        <br>
        <div class="container">
            <h3 class="text-center">Hadits {{ $hadits->name }}</h3>
            @foreach ($hadits->hadiths as $item)
            <div class="card">
                <div class="card-header">HR Bukhari Nomor {{ $item->number }}</div>
                <div class="card-body">
                    <h5 class="card-arab">{{ $item->arab }}</h5>
                    <h5 class="card-id">{{ $item->id }}</h5>  
                </div>
            </div>
            @endforeach
        </div>
        {{-- <div id="my_pdf_viewer">
            <div id="canvas_container">
                <canvas id="pdf_renderer"></canvas>
            </div>
     
            <div id="navigation_controls">
                <button id="go_previous">Previous</button>
                <input id="current_page" value="1" type="number"/>
                <button id="go_next">Next</button>
            </div>
     
            <div id="zoom_controls">  
                <button id="zoom_in">+</button>
                <button id="zoom_out">-</button>
            </div>
        </div> --}}
    </div>
</div>
@endsection

@section('scripts')
{{-- <script
src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js">
</script>
<script>
    var myState = {
            pdf: null,
            currentPage: 1,
            zoom: 1
        }
      
        pdfjsLib.getDocument('{{ asset("img/shahih-bukhari.pdf") }}').then((pdf) => {
      
            myState.pdf = pdf;
            render();
 
        });
 
        function render() {
            myState.pdf.getPage(myState.currentPage).then((page) => {
          
                var canvas = document.getElementById("pdf_renderer");
                var ctx = canvas.getContext('2d');
      
                var viewport = page.getViewport(myState.zoom);
 
                canvas.width = viewport.width;
                canvas.height = viewport.height;
          
                page.render({
                    canvasContext: ctx,
                    viewport: viewport
                });
            });
		}
		document.getElementById('go_previous').addEventListener('click', (e) => {
            if(myState.pdf == null || myState.currentPage == 1) 
              return;
            myState.currentPage -= 1;
            document.getElementById("current_page").value = myState.currentPage;
            render();
        });
 
        document.getElementById('go_next').addEventListener('click', (e) => {
            if(myState.pdf == null || myState.currentPage > myState.pdf._pdfInfo.numPages) 
               return;
            myState.currentPage += 1;
            document.getElementById("current_page").value = myState.currentPage;
            render();
        });
 
        document.getElementById('current_page').addEventListener('keypress', (e) => {
            if(myState.pdf == null) return;
          
            // Get key code
            var code = (e.keyCode ? e.keyCode : e.which);
          
            // If key code matches that of the Enter key
            if(code == 13) {
                var desiredPage = 
                document.getElementById('current_page').valueAsNumber;
                                  
                if(desiredPage >= 1 && desiredPage <= myState.pdf._pdfInfo.numPages) {
                    myState.currentPage = desiredPage;
                    document.getElementById("current_page").value = desiredPage;
                    render();
                }
            }
        });
 
        document.getElementById('zoom_in').addEventListener('click', (e) => {
            if(myState.pdf == null) return;
            myState.zoom += 0.5;
            render();
        });
 
        document.getElementById('zoom_out').addEventListener('click', (e) => {
            if(myState.pdf == null) return;
            myState.zoom -= 0.5;
            render();
        });
</script> --}}
@endsection