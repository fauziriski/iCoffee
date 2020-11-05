@extends('investasi.mitra.layout.master')
@section('title', 'Pengajuan Dana | Investasi')
@section('css')
    <link href="{{asset('investasi/mitra/css/bulma.min.css') }}" rel="stylesheet">
    <style type="text/css">
    /*!
    * Load Awesome v1.1.0 (http://github.danielcardoso.net/load-awesome/)
    * Copyright 2015 Daniel Cardoso <@DanielCardoso>
    * Licensed under MIT
    */
    .la-ball-atom,
    .la-ball-atom > div {
        position: relative;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
                box-sizing: border-box;
    }
    .la-ball-atom {
        display: block;
        font-size: 0;
        color: #fff;
    }
    .la-ball-atom.la-dark {
        color: #333;
    }
    .la-ball-atom > div {
        display: inline-block;
        float: none;
        background-color: currentColor;
        border: 0 solid currentColor;
    }
    .la-ball-atom {
        width: 32px;
        height: 32px;
    }
    .la-ball-atom > div:nth-child(1) {
        position: absolute;
        top: 50%;
        left: 50%;
        z-index: 1;
        width: 60%;
        height: 60%;
        background: #aaa;
        border-radius: 100%;
        -webkit-transform: translate(-50%, -50%);
        -moz-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            -o-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
        -webkit-animation: ball-atom-shrink 4.5s infinite linear;
        -moz-animation: ball-atom-shrink 4.5s infinite linear;
            -o-animation: ball-atom-shrink 4.5s infinite linear;
                animation: ball-atom-shrink 4.5s infinite linear;
    }
    .la-ball-atom > div:not(:nth-child(1)) {
        position: absolute;
        left: 0;
        z-index: 0;
        width: 100%;
        height: 100%;
        background: none;
        -webkit-animation: ball-atom-zindex 1.5s 0s infinite steps(2, end);
        -moz-animation: ball-atom-zindex 1.5s 0s infinite steps(2, end);
            -o-animation: ball-atom-zindex 1.5s 0s infinite steps(2, end);
                animation: ball-atom-zindex 1.5s 0s infinite steps(2, end);
    }
    .la-ball-atom > div:not(:nth-child(1)):before {
        position: absolute;
        top: 0;
        left: 0;
        width: 10px;
        height: 10px;
        margin-top: -5px;
        margin-left: -5px;
        content: "";
        background: currentColor;
        border-radius: 50%;
        opacity: .75;
        -webkit-animation: ball-atom-position 1.5s 0s infinite ease, ball-atom-size 1.5s 0s infinite ease;
        -moz-animation: ball-atom-position 1.5s 0s infinite ease, ball-atom-size 1.5s 0s infinite ease;
            -o-animation: ball-atom-position 1.5s 0s infinite ease, ball-atom-size 1.5s 0s infinite ease;
                animation: ball-atom-position 1.5s 0s infinite ease, ball-atom-size 1.5s 0s infinite ease;
    }
    .la-ball-atom > div:nth-child(2) {
        -webkit-animation-delay: .75s;
        -moz-animation-delay: .75s;
            -o-animation-delay: .75s;
                animation-delay: .75s;
    }
    .la-ball-atom > div:nth-child(2):before {
        -webkit-animation-delay: 0s, -1.125s;
        -moz-animation-delay: 0s, -1.125s;
            -o-animation-delay: 0s, -1.125s;
                animation-delay: 0s, -1.125s;
    }
    .la-ball-atom > div:nth-child(3) {
        -webkit-transform: rotate(120deg);
        -moz-transform: rotate(120deg);
            -ms-transform: rotate(120deg);
            -o-transform: rotate(120deg);
                transform: rotate(120deg);
        -webkit-animation-delay: -.25s;
        -moz-animation-delay: -.25s;
            -o-animation-delay: -.25s;
                animation-delay: -.25s;
    }
    .la-ball-atom > div:nth-child(3):before {
        -webkit-animation-delay: -1s, -.75s;
        -moz-animation-delay: -1s, -.75s;
            -o-animation-delay: -1s, -.75s;
                animation-delay: -1s, -.75s;
    }
    .la-ball-atom > div:nth-child(4) {
        -webkit-transform: rotate(240deg);
        -moz-transform: rotate(240deg);
            -ms-transform: rotate(240deg);
            -o-transform: rotate(240deg);
                transform: rotate(240deg);
        -webkit-animation-delay: .25s;
        -moz-animation-delay: .25s;
            -o-animation-delay: .25s;
                animation-delay: .25s;
    }
    .la-ball-atom > div:nth-child(4):before {
        -webkit-animation-delay: -.5s, -.125s;
        -moz-animation-delay: -.5s, -.125s;
            -o-animation-delay: -.5s, -.125s;
                animation-delay: -.5s, -.125s;
    }
    .la-ball-atom.la-sm {
        width: 16px;
        height: 16px;
    }
    .la-ball-atom.la-sm > div:not(:nth-child(1)):before {
        width: 4px;
        height: 4px;
        margin-top: -2px;
        margin-left: -2px;
    }
    .la-ball-atom.la-2x {
        width: 64px;
        height: 64px;
    }
    .la-ball-atom.la-2x > div:not(:nth-child(1)):before {
        width: 20px;
        height: 20px;
        margin-top: -10px;
        margin-left: -10px;
    }
    .la-ball-atom.la-3x {
        width: 96px;
        height: 96px;
    }
    .la-ball-atom.la-3x > div:not(:nth-child(1)):before {
        width: 30px;
        height: 30px;
        margin-top: -15px;
        margin-left: -15px;
    }
    /*
    * Animations
    */
    @-webkit-keyframes ball-atom-position {
        50% {
            top: 100%;
            left: 100%;
        }
    }
    @-moz-keyframes ball-atom-position {
        50% {
            top: 100%;
            left: 100%;
        }
    }
    @-o-keyframes ball-atom-position {
        50% {
            top: 100%;
            left: 100%;
        }
    }
    @keyframes ball-atom-position {
        50% {
            top: 100%;
            left: 100%;
        }
    }
    @-webkit-keyframes ball-atom-size {
        50% {
            -webkit-transform: scale(.5, .5);
                    transform: scale(.5, .5);
        }
    }
    @-moz-keyframes ball-atom-size {
        50% {
            -moz-transform: scale(.5, .5);
                transform: scale(.5, .5);
        }
    }
    @-o-keyframes ball-atom-size {
        50% {
            -o-transform: scale(.5, .5);
            transform: scale(.5, .5);
        }
    }
    @keyframes ball-atom-size {
        50% {
            -webkit-transform: scale(.5, .5);
            -moz-transform: scale(.5, .5);
                -o-transform: scale(.5, .5);
                    transform: scale(.5, .5);
        }
    }
    @-webkit-keyframes ball-atom-zindex {
        50% {
            z-index: 10;
        }
    }
    @-moz-keyframes ball-atom-zindex {
        50% {
            z-index: 10;
        }
    }
    @-o-keyframes ball-atom-zindex {
        50% {
            z-index: 10;
        }
    }
    @keyframes ball-atom-zindex {
        50% {
            z-index: 10;
        }
    }
    @-webkit-keyframes ball-atom-shrink {
        50% {
            -webkit-transform: translate(-50%, -50%) scale(.8, .8);
                    transform: translate(-50%, -50%) scale(.8, .8);
        }
    }
    @-moz-keyframes ball-atom-shrink {
        50% {
            -moz-transform: translate(-50%, -50%) scale(.8, .8);
                transform: translate(-50%, -50%) scale(.8, .8);
        }
    }
    @-o-keyframes ball-atom-shrink {
        50% {
            -o-transform: translate(-50%, -50%) scale(.8, .8);
            transform: translate(-50%, -50%) scale(.8, .8);
        }
    }
    @keyframes ball-atom-shrink {
        50% {
            -webkit-transform: translate(-50%, -50%) scale(.8, .8);
            -moz-transform: translate(-50%, -50%) scale(.8, .8);
                -o-transform: translate(-50%, -50%) scale(.8, .8);
                    transform: translate(-50%, -50%) scale(.8, .8);
        }
    }
	</style>
@endsection
@section('content')
<div class="col-md-8 mt-5 mx-auto">
    <div  class="card">
        <article class="card-group-item">
            <header class="card-header">
                <h6>Progress Investasi</h6>
            </header>
            <div class="card-body">
    @livewire('investasi.mitra.progress')
</div>
</article>
</div>
</div>
@endsection
@section('js')
    <script>
        const fileInput = document.querySelector('#file-js-example input[type=file]');
        fileInput.onchange = () => {
            if (fileInput.files.length > 0) {
                const fileName = document.querySelector('#file-js-example .file-name');
                fileName.textContent = fileInput.files[0].name;
                if(fileInput.files.length > 1){
                    fileName.textContent = fileInput.files.length + ' Dokumen Video';
                }
            }
        }
    </script>
    <script>
        const fileInputs = document.querySelector('#file-foto input[type=file]');
        fileInputs.onchange = () => {
            if (fileInputs.files.length > 0) {
                const fileName = document.querySelector('#file-foto .file-name');
                fileName.textContent = fileInputs.files[0].name;
                if(fileInputs.files.length > 1){
                    fileName.textContent = fileInputs.files.length + ' Dokumen Foto';
                }
            }
        }
    </script>
@endsection
