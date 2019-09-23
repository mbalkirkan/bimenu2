@extends('mobile.layout')


@section('title')
    Anasayfa
@stop


@section('header')
    {{--    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>--}}
    {{--    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>--}}
    {{--    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>--}}
    {{--    <script src="{{asset('js/instascan.min.js')}}"></script>--}}

    <style>


        #githubLink {
            position: absolute;
            right: 0;
            top: 12px;
            color: #2D99FF;
        }


        #loadingMessage {
            text-align: center;
            padding: 40px;
            background-color: #eee;
        }

        #canvas {
            width: 100%;
        }

        #output {
            margin-top: 20px;
            background: #eee;
            padding: 10px;
            padding-bottom: 0;
        }

        #output div {
            padding-bottom: 10px;
            word-wrap: break-word;
        }

        #noQRFound {
            text-align: center;
        }
    </style>
@stop

@section('js')
    <script src="{{asset('js/jsQR.js')}}"></script>
@stop


@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-6 ml-auto mr-auto">
                    <div class="card card-chart">
                        <div class="card-header">
                            <h3 class="card-title">QR Kodu Okut</h3>
                        </div>
                        <div class="card-body" align="center">
                            {{--                            <div id="app">--}}
                            {{--                                    <section class="cameras">--}}
                            {{--                                        <h2>Cameras</h2>--}}
                            {{--                                        <ul>--}}
                            {{--                                            <li v-if="cameras.length === 0" class="empty">No cameras found</li>--}}
                            {{--                                            <li v-for="camera in cameras">--}}
                            {{--                                                <span id="cameraname" v-if="camera.id == activeCameraId" :title="formatName(camera.name)" class="active"><script>var selectElement = document.querySelector('span[id="cameraname"]');--}}
                            {{--                                                        document.write(selectElement.getAttribute("title"));</script></span>--}}
                            {{--                                                <span v-if="camera.id != activeCameraId" :title="formatName(camera.name)">--}}
                            {{--                <a @click.stop="selectCamera(camera)">{ formatName(camera.name) }</a>--}}
                            {{--              </span>--}}
                            {{--                                            </li>--}}
                            {{--                                        </ul>--}}
                            {{--                                    </section>--}}
                            {{--                                    <section class="scans">--}}
                            {{--                                        <h2>Scans</h2>--}}
                            {{--                                        <ul v-if="scans.length === 0">--}}
                            {{--                                            <li class="empty">No scans yet</li>--}}
                            {{--                                        </ul>--}}
                            {{--                                        <transition-group name="scans" tag="ul">--}}
                            {{--                                            <li id="scan" v-html="scan.content" v-for="scan in scans" :key="scan.date" :title="scan.content"></li>--}}
                            {{--                                        </transition-group>--}}
                            {{--                                    </section>--}}
                            {{--                                </div>--}}
                            {{--                                <div style="  flex-direction: column;--}}
                            {{--  align-items: center;--}}
                            {{--  justify-content: center;--}}
                            {{--  display: flex;--}}
                            {{--  width:80vw;--}}
                            {{--    height:80vw;--}}
                            {{--  overflow: hidden;">--}}
                            {{--                                    <video id="preview"></video>--}}
                            {{--                                </div>--}}


                            <div id="loadingMessage">🎥 Herhangi bir kamera bulunamadı (Lütfen erişimi olan bir kameraya
                                bağlı olduğunuzdan emin olun.)
                            </div>
                            <canvas id="canvas" hidden></canvas>
                            <div id="output" hidden>
                                <div id="outputMessage">QR KOD BULUNAMADI</div>
                                <div hidden><b>Veri :</b> <span id="outputData"></span></div>
                            </div>
                            <script>
                                var video = document.createElement("video");
                                var canvasElement = document.getElementById("canvas");
                                var canvas = canvasElement.getContext("2d");
                                var loadingMessage = document.getElementById("loadingMessage");
                                var outputContainer = document.getElementById("output");
                                var outputMessage = document.getElementById("outputMessage");
                                var outputData = document.getElementById("outputData");
                                var respons=0;
                                function drawLine(begin, end, color) {
                                    canvas.beginPath();
                                    canvas.moveTo(begin.x, begin.y);
                                    canvas.lineTo(end.x, end.y);
                                    canvas.lineWidth = 4;
                                    canvas.strokeStyle = color;
                                    canvas.stroke();
                                }

                                // Use facingMode: environment to attemt to get the front camera on phones
                                navigator.mediaDevices.getUserMedia({video: {facingMode: "environment"}}).then(function (stream) {
                                    video.srcObject = stream;
                                    video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
                                    video.play();
                                    requestAnimationFrame(tick);
                                });

                                function tick() {
                                    loadingMessage.innerText = "⌛ Yükleniyor..."
                                    if (video.readyState === video.HAVE_ENOUGH_DATA) {
                                        loadingMessage.hidden = true;
                                        canvasElement.hidden = false;
                                        outputContainer.hidden = false;

                                        canvasElement.height = video.videoHeight;
                                        canvasElement.width = video.videoWidth;
                                        canvas.drawImage(video, 0, 0, canvasElement.width, (canvasElement.height / 100) * 80);
                                        var imageData = canvas.getImageData(0, 0, canvasElement.width, (canvasElement.height / 100) * 80);
                                        var code = jsQR(imageData.data, imageData.width, imageData.height, {
                                            inversionAttempts: "dontInvert",
                                        });

                                        if (code) {

                                            // drawLine(code.location.topLeftCorner, code.location.topRightCorner, "#FF3B58");
                                            // drawLine(code.location.topRightCorner, code.location.bottomRightCorner, "#FF3B58");
                                            // drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, "#FF3B58");
                                            // drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, "#FF3B58");
                                            outputMessage.hidden = true;
                                            outputData.parentElement.hidden = false;
                                            outputData.innerText = code.data;
                                            var data = code.data;

                                            if(respons==0) {
                                                respons=1;
                                                $.ajax({
                                                    url: "{{route('QRScan')}}",
                                                    type: "post",
                                                    data: '{"data":"' + data + '"}',
                                                    contentType: "application/json",
                                                    success: function (response) {
                                                        //console.log(response[0].product_name);
                                                        let timerInterval
                                                        Swal.fire({
                                                            title: 'QR Kod Okundu, Yönlendiriliyorsunuz..',

                                                            html: '<img class="img-fluid img-thumbnail" src="'+JSON.parse(response[0].product_photos)[0]+'"><br>'+response[0].product_name+'<br>'+ response[0].product_description+'<br>Masa : '+response[0].product_tables,
                                                            timer: 3000,
                                                            onBeforeOpen: () => {
                                                                Swal.showLoading()
                                                                timerInterval = setInterval(() => {
                                                                    Swal.getContent().querySelector('strong')
                                                                        .textContent = Swal.getTimerLeft()
                                                                }, 100)
                                                            },
                                                            onClose: () => {
                                                                clearInterval(timerInterval)
                                                            }
                                                        }).then((result) => {
                                                            if (
                                                                /* Read more about handling dismissals below */
                                                                result.dismiss === Swal.DismissReason.timer
                                                            ) {
                                                                window.location.href = "{{route('mobile.menu')}}";
                                                            }
                                                        })

                                                    },
                                                    error: function (jqXHR, textStatus, errorThrown) {
                                                        console.log(textStatus, errorThrown);
                                                    }
                                                });
                                            }

                                        } else {
                                            outputMessage.hidden = false;
                                            outputData.parentElement.hidden = true;
                                        }
                                    }
                                    requestAnimationFrame(tick);
                                }
                            </script>
                            {{--                            <button id="btn_scan" class="btn btn-youtube">--}}
                            {{--                                <i class="fa fa-youtube-play"></i> QR Kod Tara--}}
                            {{--                            </button>--}}

                            {{--                            <script type="text/javascript">--}}
                            {{--                                $("#btn_scan").click(function () {--}}

                            {{--                                    }--}}
                            {{--                                );--}}
                            {{--                            </script>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

