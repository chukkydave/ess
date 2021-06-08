<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-signin-client_id"
        content="341582025304-09693s1st8481k09g6qj5omt6h9tgoie.apps.googleusercontent.com">

    <title>Employee.ng | ESS </title>

    <!-- Bootstrap -->
    <link href="assets/admin_template/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="assets/admin_template/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="assets/admin_template/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="assets/admin_template/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Custom Theme Style -->
    <link href="assets/admin_template/build/css/custom.min.css" rel="stylesheet">
    <link href="assets/admin_template/vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">


    <style type="text/css">
    /*.ui-autocomplete-loading {
            background: white url("images/ui-anim_basic_16x16.gif") right center no-repeat;
          }*/

    .typeahead,
    .tt-query,
    .tt-hint {
        width: 350px;
        padding: 8px 12px;
        font-size: 12px;
        line-height: 20px;
        border: 2px solid #ccc;
        -webkit-border-radius: 8px;
        -moz-border-radius: 8px;
        border-radius: 8px;
        outline: none;
    }



    .tt-query {
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    }



    .tt-dropdown-menu {
        width: 422px;
        margin-top: 12px;
        padding: 8px 0;
        background-color: #fff;
        border: 1px solid #ccc;
        border: 1px solid rgba(0, 0, 0, 0.2);
        -webkit-border-radius: 8px;
        -moz-border-radius: 8px;
        border-radius: 8px;
        -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
        -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
        box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
    }



    .tt-suggestion.tt-cursor {
        color: #fff;
        background-color: #0097cf;

    }

    .tt-suggestion p {
        margin: 0;
    }

    .background {
        background-color: #fff;
    }

    .has-error {
        background-color: #f7cdcd;
    }

    .modal-header {
        padding: 9px 15px;

        border-bottom: 1px solid #eee;
        background-color: #0480be;
        -webkit-border-top-left-radius: 5px;
        -webkit-border-top-right-radius: 5px;
        -moz-border-radius-topleft: 5px;
        -moz-border-radius-topright: 5px;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    .green {
        color: green;
    }

    .gray {
        color: gray;
    }




    .dd {
        position: relative;
        left: -6%;
    }

    .dropzone {
        min-height: 100px;
    }



    .info-number:hover {
        display: block;
    }



    .abbrv::hover {
        display: none;
    }

    ul.msg_list li a .message {
        display: block !important;
        font-size: 11px;
        position: relative;
        left: 45px;
        text-align: left;
        padding: 0 5px;
    }

    li {
        text-decoration: none;
    }

    .dropdown-menu.msg_list span {
        white-space: normal;
        margin-right: 50px;
    }

    .sect,
    .batch {
        text-decoration: underline;
        cursor: pointer;
    }


    .nav.side-menu>li {
        background-color: #2A3F54 !important;
    }

    [data-tooltip]:hover::before {
        all: initial;
        font-family: Arial, Helvetica, sans-serif;
        display: inline-block;
        border-radius: 5px;
        padding: 10px;
        background-color: #1a1a1a;
        content: attr(data-tooltip);
        box-shadow: rgba(0, 0, 0, 0.19);
        color: #f9f9f9;
        position: absolute;
        bottom: 100%;
        width: 100px;
        left: 50%;
        transform: translate(-50%, 0);
        margin-bottom: 15px;
        text-align: center;
        font-size: 14px;
        padding: 15px;
    }

    [data-tooltip-bottom]:hover,
    [data-tooltip-left]:hover,
    [data-tooltip-right]:hover,
    [data-tooltip]:hover {
        position: relative;
        z-index: 10;

    }

    [data-tooltip-bottom]:hover::after,
    [data-tooltip-left]:hover::after,
    [data-tooltip-right]:hover::after,
    [data-tooltip]:hover::after {
        all: initial;
        display: inline-block;
        width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-top: 10px solid #1a1a1a;
        position: absolute;
        bottom: 100%;
        content: '';
        left: 50%;
        transform: translate(-50%, 0);
        margin-bottom: 5px;
    }

    [data-tooltip-right]:hover::after {
        margin-bottom: 0;
        bottom: auto;
        transform: rotate(90deg) translate(0, -50%);
        left: 100%;
        top: 50%;
        margin-left: -5px;
        margin-top: -5px;
    }

    [data-tooltip-left]:hover::after {
        margin-bottom: 0;
        bottom: auto;
        transform: rotate(-90deg) translate(0, -50%);
        left: auto;
        right: 100%;
        top: 50%;
        margin-right: -5px;
        margin-top: -5px;
    }

    [data-tooltip-bottom]:hover::after {
        margin-bottom: 0;
        bottom: auto;
        transform: rotate(180deg) translate(-50%, 0);
        top: 100%;
        margin-left: -20px;
        margin-top: 5px;
    }

    [data-tooltip-bottom]:hover::before,
    [data-tooltip-left]:hover::before,
    [data-tooltip-right]:hover::before,
    [data-tooltip]:hover::before {
        all: initial;
        font-family: Arial, Helvetica, sans-serif;
        display: inline-block;
        border-radius: 5px;
        padding: 10px;
        background-color: #1a1a1a;
        box-shadow: rgba(0, 0, 0, 0.19);
        content: attr(data-tooltip);
        color: #f9f9f9;
        position: absolute;
        bottom: 100%;
        width: 100px;
        left: 50%;
        transform: translate(-50%, 0);
        margin-bottom: 15px;
        text-align: center;
        font-size: 14px;
    }

    [data-tooltip-right]:hover::before {
        margin-bottom: 0;
        bottom: auto;
        transform: translate(0, -50%);
        left: 100%;
        top: 50%;
        content: attr(data-tooltip-right);
        margin-left: 15px;
    }

    [data-tooltip-left]:hover::before {
        margin-bottom: 0;
        bottom: auto;
        transform: translate(0, -50%);
        left: auto;
        right: 100%;
        top: 50%;
        content: attr(data-tooltip-left);
        margin-right: 15px;
    }

    [data-tooltip-bottom]:hover::before {
        margin-bottom: 0;
        bottom: auto;
        top: 100%;
        content: attr(data-tooltip-bottom);
        margin-top: 15px;
    }

    .badg {
        text-align: center;
        background: red;
        width: 20px;
        height: 20px;
        margin: 0;
        border-radius: 100%;
        position: absolute;
        top: 5px;
        left: 23px;
        padding: 5px;
    }

    .content .content-overlay {
        background: rgb(0, 175, 239, .99);
        border-radius: 10px;
        position: absolute;
        z-index: 1;
        height: 70%;
        width: 100%;
        left: 0;
        top: 0;
        bottom: 0;
        right: 0;
        opacity: 0;
        -webkit-transition: all 0.4s ease-in-out 0s;
        -moz-transition: all 0.4s ease-in-out 0s;
        transition: all 0.4s ease-in-out 0s;
    }

    .content:hover .content-overlay {
        opacity: 1;
    }

    .content-image {
        width: 100%;
    }

    .content-details {
        font-family: 'Raleway';
        position: absolute;
        font-size: 26px;
        text-align: center;
        padding-left: 1em;
        padding-right: 1em;
        width: 100%;
        top: 50%;
        left: 50%;
        opacity: 0;
        z-index: 2;
        -webkit-transform: translate(-50%, -50%);
        -moz-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        -webkit-transition: all 0.3s ease-in-out 0s;
        -moz-transition: all 0.3s ease-in-out 0s;
        transition: all 0.3s ease-in-out 0s;
    }

    .content:hover .content-details {
        top: 50%;
        left: 50%;
        opacity: 1;
    }

    .content-details h3 {
        color: #fff;
        /*font-weight: 500;*/
        letter-spacing: 0.15em;
        margin-bottom: 0.5em;
        text-transform: uppercase;
    }

    .content-details a {
        color: #fff;
        font-size: 1px;
    }

    ul {
        list-style-type: none;
    }

    li {
        list-style-type: none;
    }

    .content-details p {
        /*font-size: bold;*/
    }

    .fadeIn-top {
        top: 20%;
    }

    .app {
        /*font-family: 'Raleway', sans-serif;*/
        color: #393939;
        font-size: 24px;
        line-height: 44px;
        margin: 10px 0 0 0;
        padding: 20px 30px;
        font-weight: ;
        text-align: center;
        margin-top: 5%;
    }

    .fst_dd {
        z-index: 10;
        font-size: 16px;
        width: 80%;
        margin-left: auto;
        margin-right: auto;
        /*  position: relative;
    top: 100%;*/
        /*overflow-x: hidden;*/
    }

    .last {
        /*position: relative;
    right: 50%;*/

    }

    .first_ {
        width: 15%;
        font-size: 16px;
        margin-left: auto;
        margin-right: auto;
        /*font-weight: bold;*/
        margin-left: 10px;
    }

    .get_comp_list {
        /* display: flex;
    justify-content: center;*/
        /*width: 50%;*/
        /* margin-left: auto;
    margin-right: auto;*/
        position: relative;
        left: 10%;

        cursor: pointer;
        /*padding: 10px;*/
        width: 90%;
        color: white;
        font-size: 16px;
    }

    .message {
        position: relative;
        left: -10%;
        text-align: center;
        /*margin-top: 20px;*/
        font-size: 18px;

    }

    .image img {
        position: relative;
        left: 25%;
        width: 30%;
    }

    .abbrv {
        position: relative;
        left: -10%;
        font-size: 16px;
        text-align: center;
        font-weight: 0px;
    }

    .more {
        display: block;
    }

    .text-center {
        display: block;
    }


    .overlay {
        /*height:%; */
        width: 100%;
        /*position: fixed; 
                top: 0; 
                left: 0; */
        background-color: #fff;
        overflow-y: scroll;

        overflow-x: hidden;

        transition: 1.0s;
    }

    .overlay-content {
        display: flex;
        position: relative;
        top: 40%;
        /*left: 25%; */
        cursor: pointer;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .overlay a {
        padding: 10px;
        text-decoration: none;
        font-size: 40px;
        color: black;
        display: block;
        transition: 0.3s;
    }

    .overlay a:hover,
    .overlay a:focus {
        color: black;
    }

    .overlay .closebtn {
        position: absolute;
        top: -10px;
        right: 35px;
        /*font-size: 20px; */
    }

    .logo {
        position: absolute;
        top: 30px;
        left: 35px;
        font-size: 10px;

    }

    @keyframes click-wave {
        0% {
            height: 40px;
            width: 40px;
            opacity: 0.35;
            position: relative;
        }

        100% {
            height: 50px;
            width: 50px;
            margin-left: -20px;
            margin-top: -20px;
            opacity: 0;
        }
    }

    .option-input_ {
        -webkit-appearance: none;
        -moz-appearance: none;
        -ms-appearance: none;
        -o-appearance: none;
        appearance: none;
        position: relative;
        top: 13.33333px;
        right: 0;
        bottom: 0;
        left: 0;
        height: 20px;
        width: 20px;
        transition: all 0.15s ease-out 0s;
        background: #cbd1d8;
        border: none;
        color: #fff;
        cursor: pointer;
        display: inline-block;
        margin-right: 0.5rem;
        outline: none;
        position: relative;
        z-index: 1000;
    }

    .option-input_:hover {
        background: #9faab7;
    }

    .option-input_:checked {
        background: #2A3F54;
    }

    .option-input_:checked::before {
        height: 20px;
        width: 20px;
        position: absolute;
        content: '✔';
        display: inline-block;
        font-size: 26.66667px;
        text-align: center;
        line-height: 20px;
    }

    .option-input_:checked::after {
        -webkit-animation: click-wave 0.65s;
        -moz-animation: click-wave 0.65s;
        animation: click-wave 0.65s;
        background: #40e0d0;
        content: '';
        display: block;
        position: relative;
        z-index: 100;
    }

    .option-input_.radio_ {
        border-radius: 50%;
    }

    .option-input_.radio_::after {
        border-radius: 50%;
    }




    .dd {
        position: relative;
        left: -6%;
    }

    .dropzone {
        min-height: 100px;
    }



    .info-number:hover {
        display: block;
    }



    .abbrv::hover {
        display: none;
    }

    ul.msg_list li a .message {
        display: block !important;
        font-size: 11px;
        position: relative;
        left: 45px;
        text-align: left;
        padding: 0 5px;
    }

    li {
        text-decoration: none;
    }

    .dropdown-menu.msg_list span {
        white-space: normal;
        margin-right: 50px;
    }

    .sect,
    .batch {
        text-decoration: underline;
        cursor: pointer;
    }


    .nav.side-menu>li {
        background-color: #2A3F54 !important;
    }

    [data-tooltip]:hover::before {
        all: initial;
        font-family: Arial, Helvetica, sans-serif;
        display: inline-block;
        border-radius: 5px;
        padding: 10px;
        background-color: #1a1a1a;
        content: attr(data-tooltip);
        box-shadow: rgba(0, 0, 0, 0.19);
        color: #f9f9f9;
        position: absolute;
        bottom: 100%;
        width: 100px;
        left: 50%;
        transform: translate(-50%, 0);
        margin-bottom: 15px;
        text-align: center;
        font-size: 14px;
        padding: 15px;
    }

    [data-tooltip-bottom]:hover,
    [data-tooltip-left]:hover,
    [data-tooltip-right]:hover,
    [data-tooltip]:hover {
        position: relative;
        z-index: 10;

    }

    [data-tooltip-bottom]:hover::after,
    [data-tooltip-left]:hover::after,
    [data-tooltip-right]:hover::after,
    [data-tooltip]:hover::after {
        all: initial;
        display: inline-block;
        width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-top: 10px solid #1a1a1a;
        position: absolute;
        bottom: 100%;
        content: '';
        left: 50%;
        transform: translate(-50%, 0);
        margin-bottom: 5px;
    }

    [data-tooltip-right]:hover::after {
        margin-bottom: 0;
        bottom: auto;
        transform: rotate(90deg) translate(0, -50%);
        left: 100%;
        top: 50%;
        margin-left: -5px;
        margin-top: -5px;
    }

    [data-tooltip-left]:hover::after {
        margin-bottom: 0;
        bottom: auto;
        transform: rotate(-90deg) translate(0, -50%);
        left: auto;
        right: 100%;
        top: 50%;
        margin-right: -5px;
        margin-top: -5px;
    }

    [data-tooltip-bottom]:hover::after {
        margin-bottom: 0;
        bottom: auto;
        transform: rotate(180deg) translate(-50%, 0);
        top: 100%;
        margin-left: -20px;
        margin-top: 5px;
    }

    [data-tooltip-bottom]:hover::before,
    [data-tooltip-left]:hover::before,
    [data-tooltip-right]:hover::before,
    [data-tooltip]:hover::before {
        all: initial;
        font-family: Arial, Helvetica, sans-serif;
        display: inline-block;
        border-radius: 5px;
        padding: 10px;
        background-color: #1a1a1a;
        box-shadow: rgba(0, 0, 0, 0.19);
        content: attr(data-tooltip);
        color: #f9f9f9;
        position: absolute;
        bottom: 100%;
        width: 100px;
        left: 50%;
        transform: translate(-50%, 0);
        margin-bottom: 15px;
        text-align: center;
        font-size: 14px;
    }

    [data-tooltip-right]:hover::before {
        margin-bottom: 0;
        bottom: auto;
        transform: translate(0, -50%);
        left: 100%;
        top: 50%;
        content: attr(data-tooltip-right);
        margin-left: 15px;
    }

    [data-tooltip-left]:hover::before {
        margin-bottom: 0;
        bottom: auto;
        transform: translate(0, -50%);
        left: auto;
        right: 100%;
        top: 50%;
        content: attr(data-tooltip-left);
        margin-right: 15px;
    }

    [data-tooltip-bottom]:hover::before {
        margin-bottom: 0;
        bottom: auto;
        top: 100%;
        content: attr(data-tooltip-bottom);
        margin-top: 15px;
    }

    .badg {
        text-align: center;
        background: red;
        width: 20px;
        height: 20px;
        margin: 0;
        border-radius: 100%;
        position: absolute;
        top: 5px;
        left: 23px;
        padding: 5px;
    }

    .content .content-overlay {
        background: rgb(0, 175, 239, .99);
        border-radius: 10px;
        position: absolute;
        z-index: 1;
        height: 70%;
        width: 100%;
        left: 0;
        top: 0;
        bottom: 0;
        right: 0;
        opacity: 0;
        -webkit-transition: all 0.4s ease-in-out 0s;
        -moz-transition: all 0.4s ease-in-out 0s;
        transition: all 0.4s ease-in-out 0s;
    }

    .content:hover .content-overlay {
        opacity: 1;
    }

    .content-image {
        width: 100%;
    }

    .content-details {
        font-family: 'Raleway';
        position: absolute;
        font-size: 26px;
        text-align: center;
        padding-left: 1em;
        padding-right: 1em;
        width: 100%;
        top: 50%;
        left: 50%;
        opacity: 0;
        z-index: 2;
        -webkit-transform: translate(-50%, -50%);
        -moz-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        -webkit-transition: all 0.3s ease-in-out 0s;
        -moz-transition: all 0.3s ease-in-out 0s;
        transition: all 0.3s ease-in-out 0s;
    }

    .content:hover .content-details {
        top: 50%;
        left: 50%;
        opacity: 1;
    }

    .content-details h3 {
        color: #fff;
        /*font-weight: 500;*/
        letter-spacing: 0.15em;
        margin-bottom: 0.5em;
        text-transform: uppercase;
    }

    .content-details a {
        color: #fff;
        font-size: 1px;
    }

    ul {
        list-style-type: none;
    }

    li {
        list-style-type: none;
    }

    .content-details p {
        /*font-size: bold;*/
    }

    .fadeIn-top {
        top: 20%;
    }

    .app {
        /*font-family: 'Raleway', sans-serif;*/
        color: #393939;
        font-size: 24px;
        line-height: 44px;
        margin: 10px 0 0 0;
        padding: 20px 30px;
        font-weight: ;
        text-align: center;
        margin-top: 5%;
    }

    .fst_dd {
        z-index: 10;
        font-size: 16px;
        width: 80%;
        margin-left: auto;
        margin-right: auto;
        /*  position: relative;
  top: 100%;*/
        /*overflow-x: hidden;*/
    }

    .last {
        /*position: relative;
  right: 50%;*/

    }

    .first_ {
        width: 15%;
        font-size: 16px;
        margin-left: auto;
        margin-right: auto;
        /*font-weight: bold;*/
        margin-left: 10px;
    }

    .get_comp_list {
        /* display: flex;
  justify-content: center;*/
        /*width: 50%;*/
        /* margin-left: auto;
  margin-right: auto;*/
        position: relative;
        left: 10%;

        cursor: pointer;
        /*padding: 10px;*/
        width: 90%;
        color: white;
        font-size: 16px;
    }

    .message {
        position: relative;
        left: -10%;
        text-align: center;
        /*margin-top: 20px;*/
        font-size: 18px;

    }

    .image img {
        position: relative;
        left: 25%;
        width: 30%;
    }

    .abbrv {
        position: relative;
        left: -10%;
        font-size: 16px;
        text-align: center;
        font-weight: 0px;
    }

    .more {
        display: block;
    }

    .text-center {
        display: block;
    }


    .overlay {
        /*height:%; */
        width: 100%;
        /*position: fixed; 
            top: 0; 
            left: 0; */
        background-color: #fff;
        overflow-y: scroll;

        overflow-x: hidden;

        transition: 1.0s;
    }

    .overlay-content {
        display: flex;
        position: relative;
        top: 40%;
        /*left: 25%; */
        cursor: pointer;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .overlay a {
        padding: 10px;
        text-decoration: none;
        font-size: 40px;
        color: black;
        display: block;
        transition: 0.3s;
    }

    .overlay a:hover,
    .overlay a:focus {
        color: black;
    }

    .overlay .closebtn {
        position: absolute;
        top: -10px;
        right: 35px;
        /*font-size: 20px; */
    }

    .logo {
        position: absolute;
        top: 30px;
        left: 35px;
        font-size: 10px;

    }

    @keyframes click-wave {
        0% {
            height: 40px;
            width: 40px;
            opacity: 0.35;
            position: relative;
        }

        100% {
            height: 50px;
            width: 50px;
            margin-left: -20px;
            margin-top: -20px;
            opacity: 0;
        }
    }

    .typeahead,
    .tt-query,
    .tt-hint {
        width: 350px;
        padding: 8px 12px;
        font-size: 12px;
        line-height: 20px;
        border: 2px solid #ccc;
        -webkit-border-radius: 8px;
        -moz-border-radius: 8px;
        border-radius: 8px;
        outline: none;
    }

    .tt-query {
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    }

    .tt-dropdown-menu {
        width: 422px;
        margin-top: 12px;
        padding: 8px 0;
        background-color: #fff;
        border: 1px solid #ccc;
        border: 1px solid rgba(0, 0, 0, 0.2);
        -webkit-border-radius: 8px;
        -moz-border-radius: 8px;
        border-radius: 8px;
        -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
        -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
        box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
    }

    .tt-suggestion.tt-cursor {
        color: #fff;
        background-color: #0097cf;
    }

    .tt-suggestion p {
        margin: 0;
    }

    .background {
        background-color: #fff;
    }

    .has-error {
        background-color: #f7cdcd;
    }

    .modal-header {
        padding: 9px 15px;
        border-bottom: 1px solid #eee;
        background-color: #0480be;
        -webkit-border-top-left-radius: 5px;
        -webkit-border-top-right-radius: 5px;
        -moz-border-radius-topleft: 5px;
        -moz-border-radius-topright: 5px;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    .green {
        color: green;
    }

    .gray {
        color: gray;
    }

    #page_error_div {
        width: 50%;
        height: 100px;
        margin: 100px auto;
        margin-top: calc(100vh / 2 - 50px);
        text-align: center;
    }




    .container33 {
        width: 80px;
        height: 100px;
        margin: 100px auto;
        margin-top: calc(100vh / 2 - 50px);
    }

    .block33 {
        position: relative;
        box-sizing: border-box;
        float: left;
        margin: 0 10px 10px 0;
        width: 12px;
        height: 12px;
        border-radius: 3px;
        background: #FFF;
    }

    .block33:nth-child(4n+1) {
        animation: wave 2s ease .0s infinite;
    }

    .block33:nth-child(4n+2) {
        animation: wave 2s ease .2s infinite;
    }

    .block33:nth-child(4n+3) {
        animation: wave 2s ease .4s infinite;
    }

    .block33:nth-child(4n+4) {
        animation: wave 2s ease .6s infinite;
        margin-right: 0;
    }

    @keyframes wave {
        0% {
            top: 0;
            opacity: 1;
        }

        50% {
            top: 30px;
            opacity: .2;
        }

        100% {
            top: 0;
            opacity: 1;
        }
    }




    /*for sections*/
    div#navbar_div ul {
        padding: 0;
        margin: 0;
        list-style-type: none;
        position: relative;
    }

    div#navbar_div li {
        list-style-type: none;
        border-left: 2px solid #000;
        margin-left: 1em;
    }

    div#navbar_div li div {
        padding-left: 1em;
        position: relative;
    }

    div#navbar_div li div::before {
        content: '';
        position: absolute;
        top: 0;
        left: -2px;
        bottom: 50%;
        width: 0.75em;
        border: 2px solid #000;
        border-top: 0 none transparent;
        border-right: 0 none transparent;
    }

    div#navbar_div ul>li:last-child {
        border-left: 2px solid transparent;
    }

    /*end of for sections*/



    .costing_cnc {
        display: none;
    }
    </style>

    <!-- jQuery -->
    <!-- remember: move to footer -->
    <!-- jQuery -->
    <script src="assets/admin_template/vendors/jquery/dist/jquery.min.js?v=1.1"></script>
    <!-- Bootstrap -->

    <script src="assets/js/common.js?v=1.2"></script>

    <script src="assets/admin_template/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/admin_template/vendors/twbs-pagination-1.4.0/jquery.twbsPagination.js" type="text/javascript">
    </script>
    <script src="assets/js/jquerysession.js?v=1"></script>
    <script src="assets/js/wms.js?v=2.0"></script>
    <script src="assets/js/jquery-ui.min.js?v=1"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- jQuery autocomplete -->
    <!-- <script src="assets/admin_template/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script> -->


    <script src="assets/admin_template/vendors/dropzone/dist/min/dropzone.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js">
    </script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>

    <script>
    // window.fbAsyncInit = function() {
    //   FB.init({
    //     appId      : '597385214051815',
    //     cookie     : true,
    //     xfbml      : true,
    //     version    : 'v3.2'
    //   });
    //   FB.getLoginStatus(function(response) {
    //       statusChangeCallback(response);
    //   });

    // };
    // (function(d, s, id){
    //    var js, fjs = d.getElementsByTagName(s)[0];
    //    if (d.getElementById(id)) {return;}
    //    js = d.createElement(s); js.id = id;
    //    js.src = "https://connect.facebook.net/en_US/sdk.js";
    //    fjs.parentNode.insertBefore(js, fjs);
    //  }(document, 'script', 'facebook-jssdk'));

    // function statusChangeCallback(response){

    //    FB.api('/me', 'GET', {fields: 'first_name,last_name,name,id,picture.width(150).height(150)'}, function(response) {
    //       document.getElementById('username').innerHTML = "<img src='" + response.picture.data.url + "'><span class=' fa fa-angle-down'></span> ";
    //   })
    //    console.log(response);
    //     if(response.status === 'connected'){

    //       var str = "";
    //       var str2 = "";
    //       str += '<li><a href="'+window.location.origin+'/user/change_password">Change Password</a></li>';
    //       str += '<li><a onclick="function hi(){ FB.getLoginStatus(function(response) { if (response && response.status === \'connected\') { FB.logout(function(response) { localStorage.clear();  window.location.href = \''+site_url+'\'; }); } }); }; hi();" ><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>';

    //       str2 += '<a data-toggle="tooltip" data-placement="top" title="Logout" onclick="function hi(){ FB.getLoginStatus(function(response) { if (response && response.status === \'connected\') { FB.logout(function(response) { localStorage.clear();  window.location.href = \''+site_url+'\'; }); } }); }; hi(); ">';
    //       str2 += '<span class="glyphicon glyphicon-off" aria-hidden="true" ></span>';

    //       $('#user_list').html(str);
    //       $('#footer_logout').append(str2);


    //     } else {
    //       console.log('Not authenticated');

    //     }

    // } 
    </script>

    <script>
    // function signOut() {

    //   localStorage.clear();
    //   window.location.href = window.location.origin;
    //   window.open('https://mail.google.com/a/employee.IN/?logout&hl=en','logout_from_google','width=600,height=300,menubar=no,status=no,location=no,toolbar=no,scrollbars=no,top=20,left=20 display=none');

    // }

    //  function show_login_status(network, status){
    //   if (status){
    //     var str = "";
    //     var str2 = "";
    //     str2 += '<li><a href="'+window.location.origin+'/user/change_password">Change Password</a></li>';
    //     str2 += '<li><a onclick="signOut()" ><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>';


    //     str += '<a data-toggle="tooltip" data-placement="top" title="Logout" onclick="signOut()">';
    //     str += '<span class="glyphicon glyphicon-off" aria-hidden="true" ></span></a>';

    //     $('#user_list').html(str2);
    //     // $('#footer_logout').append(str);
    //     $('#username').html('<img src="assets/admin_template/production/images/img.jpg" alt=""><span class=" fa fa-angle-down"></span>');
    //    console.log("Logged in to " + network);

    //   }else{

    //    console.log("Not logged in to " + network);
    //    $('#username').html('<img src="assets/admin_template/production/images/img.jpg" alt=""><span class=" fa fa-angle-down"></span>');
    //    var str2 = "";
    //    var str = "";
    //    str2 += '<li><a href="'+window.location.origin+'/user/change_password">Change Password</a></li>';
    //    str2 += '<li><a onclick="localStorage.clear(); window.location.href = \''+site_url+'\';" ><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>';

    //    str += '<a data-toggle="tooltip" data-placement="top" title="Logout" onclick="localStorage.clear();  window.location.href = \''+site_url+'\';">';
    //    str += '<span class="glyphicon glyphicon-off" aria-hidden="true" ></span>';

    //    $('#user_list').html(str2);
    //    $('#footer_logout').append(str);
    //   }
    //  }
    </script>



    <script type="text/javascript">
    $(document).ready(function() {
        function openNav() {
            document.getElementById(
                "myNav").style.width = "100%";
        }


        function closeNav() {
            document.getElementById(
                "myNav").style.height = "0%";
        }



        if (localStorage.getItem('user_id') == "" && localStorage.getItem('company_id') == "") {
            //redirect user to login page
            window.location.href = site_url;

        } else {

            fetch_company_colors();
            // user_access();

        }


        if (localStorage.getItem('profile_photo') == "" || localStorage.getItem('profile_photo') == null ||
            localStorage.getItem('profile_photo') == undefined) {

            $('#profile_img').attr('src', '/files/images/user_profile_images/sml_default_picture.png');

        } else {

            $('#profile_img').attr('src', '/files/images/user_profile_images/sml_' + localStorage.getItem(
                'profile_photo'));

        }



    });
    $(document).on('click', '.get_comp_list', function() {

        var id = $(this).attr("id").replace(/themodli_/, '');
        var compn_and_d = $(this).attr("dir").split("-");
        var module_name = compn_and_d[0];

        $("#list_comp_tables").html($("#comp_todi_" + id).html());
        $(".mdl_hdn").html("Which company's " + module_name + "?");
        $("#modal_choose_company").modal("show");

    });
    $(document).on('click', '.set_coy', function() {

        var compn_and_d = $(this).attr("dir").split("-");
        var company_id = compn_and_d[1];
        var md_landing_page = compn_and_d[2]
        localStorage.setItem('company_id', company_id);
        // alert(localStorage.getItem('company_id'));
        // localStorage.setItem('company_name', company_name);

        window.location.href = "../" + md_landing_page;

    });

    function fetch_company_colors() {

        var company_id = localStorage.getItem('company_id');

        $.ajax({

            type: "POST",
            dataType: "json",
            url: api_path + "company/get_company_colours",
            data: {
                "company_id": company_id
            },
            timeout: 60000,

            success: function(response) {



                if (response.status == '200') {

                    var color = '#2A3F54';
                    if (response.data.middle_left_bar == '' || response.data.middle_left_bar == null) {
                        response.data.middle_left_bar = color;
                    }

                    if (response.data.body_color == '' || response.data.body_color == null) {
                        response.data.body_color = color;
                    }

                    if (response.data.bottom_left_bar == '' || response.data.bottom_left_bar == null) {
                        response.data.bottom_left_bar = color;
                    }

                    if (response.data.top_left_bar == '' || response.data.top_left_bar == null) {
                        response.data.top_left_bar = color;
                    }


                    $('.left_col').css('background', response.data.middle_left_bar);
                    $('body').css('background', response.data.body_color);
                    // $('a').css('background', response.data.body_color);
                    $('.sidebar-footer').css('background', response.data.bottom_left_bar);
                    $('.sidebar-footer a').css('background', response.data.bottom_left_bar);
                    $('.site_title').css('background', response.data.top_left_bar);
                    $('table.jambo_table thead').css('background', response.data.body_color);
                    $('ul.side-menu li a').children().css('background-color', response.data.body_color);

                    can_user_access_this_module();
                    // fetch_company_colors();
                    $('#whole_body').show();

                }

            },
            // objAJAXRequest, strError
            error: function(response) {

                alert('Connection error!');

            }

        });
    }


    function group_modules_users_can_access() {

        // return;

        var user_id = localStorage.getItem('user_id');
        var company_id = localStorage.getItem('company_id');

        var pathArray = window.location.href.split('/');
        var username = pathArray[2].split('.')[0];

        $.ajax({

            type: "GET",
            dataType: "json",
            url: api_path + "user/group_modules_users_can_access",
            data: {
                "user_id": user_id,
                "company_id": company_id,
                "token": localStorage.getItem('token')
            },
            timeout: 60000,

            success: function(response) {

                console.log(response);

                $('#user_name').html(localStorage.getItem('firstname') + ' ' + localStorage.getItem(
                    'lastname'));
                $('#hi_user_name').html(localStorage.getItem('firstname'));
                $('.hi_user_name').html(localStorage.getItem('firstname'));

                if (response.status == '200') {
                    // $(".fst_dd").append(list_mds+'<li><div class="text-center"><a href="/user/myapps"><strong>Add More Apps </strong><i class="fa fa-angle-right"></i></a></div></li>');
                    for_default = `<option value='2'>Workgroup</option>`;

                    $.each(response.data, function(i, v) {
                        console.log(v)
                        if (v.module_full_name) {
                            console.log(v.module_full_name)
                            for_default +=
                                `<option value='${v.module_id}'>${v.module_full_name}</option>`
                        }
                    })
                    if (response.total_rows != 0) {

                        var k = 1;
                        var list_mds = "";
                        list_mds +=
                            `<div class="col-md-2" data-tooltip="Workgroup">
                               <li class="dd" style="position: relative; left:-7%" >   <a style="position: relative;
                               right: 20%;" href="../workgroup" class="get_comp_list" id="themodli_"  data="feeds"><span class="image"><img src="../files/images/icons/feeds_icon.png" alt="" style="position:relative; left:33%;"></span>     <span>        <div class="abbrv" ><span class="" style="position:relative; left:10%;">Workgroup</div></span></span>   </a></li></div>`;
                        $.each(response.data, function(i, v) {

                            if (v.access_count == 1) {

                                var link_lk = 'class="get_comp_list"';
                                var set_coy_class = "";

                            } else {

                                var link_lk = 'class="get_comp_list"';
                                var set_coy_class = "";

                            }




                            list_mds +=
                                '<div class="col-md-2"  style="font-size:10px" data-tooltip="' +
                                v.module_full_name + '"> <div class="">  <li>   <a ' + link_lk +
                                ' id="themodli_' + v.module_id + '" dir="' + v.module_abbrv + "-" +
                                v.company_id + "-" + v.company_name + '"  class="' + set_coy_class +
                                '" data="' + v.module_landing_page +
                                '">   <span class="image"><img src="../files/images/icons/' + v
                                .module_little_icon +
                                '" alt=""></span>     <span>        <div class="abbrv" ><span class="">' +
                                v.module_abbrv +
                                '</span></div>      <div class="message"></div>                      </a>          </li></div></div></span>';






                            // list_mds +=
                            //     '<span><div class="col-md-3 first_"  style="font-size:10px" data-tooltip="' +
                            //     v.module_full_name + '"> <div class="">  <li>   <a ' + link_lk +
                            //     ' id="themodli_' + v.module_id + '" dir="' + v.module_abbrv + "-" +
                            //     v.company_id + "-" + v.company_name + '"  class="' + set_coy_class +
                            //     '" data="' + v.module_landing_page +
                            //     '">   <span class="image"><img src="../files/images/icons/' + v
                            //     .module_little_icon +
                            //     '" alt=""></span>     <span>        <div class="abbrv" ><span class="hide_hover">' +
                            //     v.module_abbrv +
                            //     '</span></div> </span>       <div class="message"></div>                      </a>          </li></div></div></span>';





                            //         <a id="feed_tg" href="../feeds">
                            // <span class="tooltiptext">'+v.module_full_name+'</span>
                            //                     <span class="image"><img src="../files/images/icons/feeds_icon.png" alt=""></span>
                            //                     <span>
                            //   <span><b>Feeds</b></span>

                            //                     </span>
                            //                     <span class="message">
                            //   Notifications Feeds
                            // </span>
                            //                 </a>

                            list_mds += '<span id="comp_todi_' + v.module_id +
                                '" style="display: none">';
                            $.each(v.more_comp_list, function(i2, v2) {
                                list_mds +=
                                    '<li class="" style="display:"><a class="set_coy"   dir="' +
                                    v.module_abbrv + "-" + v2.id + "-" + v2.landing_page +
                                    '" style="cursor: pointer" >' + v2.comp_name +
                                    '</a></li>';
                            });
                            list_mds += '</span>';

                            // k++;


                            // list_mds += '<span id="comp_todi_'+v.module_id+'" style="display: none">';
                            // $.each(v.more_comp_list, function (i2, v2){
                            //   list_mds += '<li class="" style="display:"><a class="set_coy"   dir="'+v.module_abbrv+"-"+v2.id+"-"+v2.landing_page+'" style="cursor: pointer" >'+v2.comp_name+'</a></li>';

                            // });
                            // list_mds += '</span>';

                            k++;

                        });

                        $(".fst_dd").append(list_mds);
                        $(".set_").append(for_default);

                        // $( list_mds ).insertAfter( ".fst_dd" );
                    } else {


                    }

                    // $('#whole_body').show();

                    // fetch_company_colors();

                } else {

                    // fetch_company_colors();

                }

            },
            error: function(response) {

                fetch_company_colors();
            }

        });

    }

    // function group_modules_users_can_access(){

    //   var user_id = localStorage.getItem('user_id');
    //   var company_id = localStorage.getItem('company_id');

    //   var pathArray = window.location.href.split('/');
    //   var username = pathArray[2].split('.')[0];

    //   $.ajax({

    //     type: "POST",
    //     dataType: "json",
    //     url: api_path+"user/modules_users_can_access_within_company",
    //     data: { "user_id" : user_id , "company_id" : company_id  },
    //     timeout: 60000,

    //     success: function(response) {

    //         if (response.status == '200'){


    //           if(response.total_rows != 0){

    //             var k = 1;
    //             var list_mds = "";
    //             $.each(response.data, function (i, v) {


    //               if(v.access_count == 1){

    //                 var link_lk = ' href="'+site_url+'/'+v.module_landing_page+'" ';
    //                 var set_coy_class = "set_coy";

    //               }else{

    //                 var link_lk = 'class="get_comp_list"';
    //                 var set_coy_class = "";

    //               }


    //               list_mds += '<li>   <a '+link_lk+' id="themodli_'+v.module_id+'"  dir="'+v.module_abbrv+"-"+v.company_id+"-"+v.company_name+'" class="'+set_coy_class+'" >   <span class="image"><img src="../files/images/icons/'+v.module_little_icon+'" alt=""></span>     <span>        <span><b>'+v.module_abbrv+'</b></span> </span>       <span class="message">'+v.module_full_name+'</span>                      </a>          </li>';



    //               list_mds += '<span id="comp_todi_'+v.module_id+'" style="display: none">';
    //               $.each(v.more_comp_list, function (i2, v2){
    //                 list_mds += '<li class="" style="display:"><a href="https://employee.ng/'+v2.landing_page+'" class="set_coy"   dir="'+v.module_abbrv+"-"+v2.company_id+"-"+v2.comp_name+'" >'+v2.comp_name+'</a></li>';
    //               });
    //               list_mds += '</span>';




    //               k++;

    //             });

    //             $(".fst_dd").append(list_mds+'<li><div class="text-center"><a href="https://'+username+'.employee.ng/user/modules_list4"><strong>Add More Apps </strong><i class="fa fa-angle-right"></i></a></div></li>');
    //             // $( list_mds ).insertAfter( ".fst_dd" );
    //             $("#feed_tg").attr("href", site_url+"/feeds");

    //           }else{

    //             // alert("No sd");

    //           }


    //         }else{

    //           // alert("You do not have access to this module");
    //           // $('#whole_body').html('<font color="black">You do not have access to this module</font>');

    //         }

    //       },

    //       error: function(response){
    //         // alert("error");
    //         // console.log(response);
    //         // alert("You do not have access to this module");
    //         // $("#whole_body").html('<font color="black">You do not have access to this module</font>');
    //       }        

    //   });

    // }

    function can_user_access_this_module() {

        var company_id = localStorage.getItem('company_id');
        var user_id = localStorage.getItem('user_id');
        var module_id = 3;

        $.ajax({

            type: "POST",
            dataType: "json",
            url: api_path + "user/can_user_access_this_module",
            data: {
                "company_id": company_id,
                "user_id": user_id,
                "module_id": module_id
            },
            timeout: 60000,

            success: function(response) {

                if (response.status == '200') {


                    module_ess_access();
                    $('#user_name').html(localStorage.getItem('firstname') + ' ' + localStorage.getItem(
                        'lastname'));


                } else {

                    alert("You do not have access to this module");
                    $('#whole_body').html(
                        '<font color="black">You do not have access to this module</font>');

                }

            },

            error: function(response) {
                alert("You do not have access to this module");
                $("#whole_body").html('<font color="black">You do not have access to this module</font>');
            }

        });

    }




    function fetch_user_module_roles() {

        var company_id = localStorage.getItem('company_id');
        var user_id = localStorage.getItem('user_id');
        var module_id = 3;

        $.ajax({

            type: "POST",
            dataType: "json",
            url: api_path + "user/get_user_roles_in_modules",
            data: {
                "company_id": company_id,
                "user_id": user_id,
                "module_id": module_id
            },
            timeout: 60000,

            success: function(response) {

                console.log(response);

                if (response.status == '200') {

                    var k = 1;
                    $.each(response['data'], function(i, v) {

                        if (v.role_id == 4) { //a
                            $("#settings").show();
                            $("#tasks").show();
                        }

                        if (v.role_id == 2) { //marketing
                            $("#dashboard_link").show(); //dashboard major link
                            $("#dashb_index").show(); //basic dashboard
                            $("#opportunities").show();
                            $("#clients").show();
                            $("#tasks").show();
                        }

                        if (v.role_id == 1) { //project director
                            $("#dashboard_link").show(); //dashboard major link
                            $("#dashb_index").show(); //basic dashboard
                            $("#dashb_pm").show(); //basic dashboard
                            $("#projects").show();
                            $("#projects_basic").hide(); //hide basic project
                            $("#tasks").show();
                        }


                        if (v.role_id == 3) { //project manager
                            $("#dashboard_link").show(); //dashboard major link
                            $("#dashb_index").show(); //basic dashboard
                            $("#projects_basic").show(); //show basic project
                            $("#projects").hide(); //hide director's project page
                            $("#tasks").show();

                        }

                        k++;
                    });


                } else if (response.status == '400') {


                } else if (response.status == "401") {


                }

            },

            error: function(response) {


            }

        });
    }


    function page_ess_access() {

        var company_id = localStorage.getItem('company_id');

        var user_id = localStorage.getItem('user_id');
        var module_id = 3;


        $.ajax({

            type: "POST",
            dataType: "json",
            url: api_path + "accesscontrol/check_if_admin",
            data: {
                "company_id": company_id,
                "user_id": user_id,
                "module_id": module_id
            },
            timeout: 60000,

            success: function(response) {

                console.log(response);


                if (response.status == '200') {

                    $('#user_page').show();

                } else if (response.status == '400') {



                } else if (response.status == "401") {
                    //missing parameters


                }


            },

            error: function(response) {




            }

        });
    }


    function module_ess_access() {

        var user_id = localStorage.getItem('user_id');
        var company_id = localStorage.getItem('company_id');


        $.ajax({

            type: "POST",
            dataType: "json",
            url: api_path + "accesscontrol/check_if_connected",
            data: {
                "user_id": user_id,
                "company_id": company_id
            },
            timeout: 60000,

            success: function(response) {

                console.log(response);


                if (response.status == '200') {

                    group_modules_users_can_access();

                    $("#whole_body").show();

                    //2.
                    fetch_user_module_roles();

                } else {

                    //missing parameters
                    window.location.href = site_url + "/user/user_access";

                }


            },

            error: function(response) {




            }

        });
    }


    function user_access() {

        var user_id = localStorage.getItem('user_id');
        var company_id = localStorage.getItem('company_id');
        var firstname = localStorage.getItem('firstname');
        var lastname = localStorage.getItem('lastname');
        var link = base_url + "modules";


        $.ajax({

            type: "POST",
            dataType: "json",
            url: api_path + "accesscontrol/perm_controls",
            data: {
                "user_id": user_id
            },
            timeout: 60000, // sets timeout to one minute

            error: function(response) {
                localStorage.clear();
                window.location.href = site_url;
                alert('Connection error');

            },

            success: function(response) {

                console.log(response);
                if (response.status == '200') {

                    function status(string) {
                        return string.charAt(0).toUpperCase() + string.slice(1);
                    }
                    // alert('success');
                    if (!user_id) {

                        $('body').addClass('background');
                        window.location.href = site_url;

                    } else if (user_id !== undefined && location.href == link && company_id == undefined) {

                        window.location.href = base_url;

                    } else {
                        module_ess_access();
                        page_ess_access();
                        $('body').fadeIn();
                    }

                } else if (response.status == '401') {

                    $('body').hide();
                    window.location.href = site_url + "/cv/edit";

                } else {

                    alert('No module access');
                    window.location.href = site_url + "/user";
                }

            }
        });
    }
    </script>
</head>

<body class="nav-md" style="display: none;" id="whole_body">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>ESS</span></a>
                    </div>

                    <div class="clearfix"></div>



                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">

                            <ul class="nav side-menu">
                                <li><a href="/ess/"><i class="fa fa-home"></i> Home </a>
                                </li>
                                <li><a href="leaves"><i class="fa fa-edit"></i> Leaves </a>
                                </li>
                                <!-- <li><a href="payslips"><i class="fa fa-desktop"></i> Payslips </a>              
                  </li>

                  <li><a href="timesheets"><i class="fa fa-bell-o"></i> Timesheets </a>
                  </li>

                  <li><a href="resignation"><i class="fa fa-desktop"></i> Resignation </a>
                  </li>

                   -->
                                <li><a href="grievances"><i class="fa fa-desktop"></i> Grievances </a>
                                </li>



                                <li><a href="approvals"><i class="fa fa-list-alt"></i> Approvals </a>
                                </li>
                                <li><a href="work_profile"><i class="fa fa-folder"></i> Work Profile </a>
                                </li>
                                <!-- <li><a href="expense_claims"><i class="fa fa-desktop"></i> Expense Claims </a>
                  </li> -->


                                <li id="user_page" style="display: none;"><a><i class="fa fa-gear"></i> Settings <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="users">Users</a></li>
                                    </ul>
                                </li>

                            </ul>
                        </div>


                    </div>
                    <!-- /sidebar menu -->


                    <!-- modal for apps company question -->



                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small" id="footer_logout">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout"
                            onclick="localStorage.clear();  window.location.href = site_url ">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <div class="col-md-12">
                <div id="myNav" class="overlay" style="z-index: 10">
                    <!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" style="color: #09B1F0; font-size: 40px"> × </a>  -->
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"
                        style="color: #09B1F0; font-size: 40px"> × </a>
                    <a href="javascript:void(0)" class="logo" onclick="closeNav()" style="font-size: 16px">
                        <img src="../nahere_logo_blue.png" alt="alternative" style="width: 28px">
                        <span> NaHere!</span>
                    </a>
                    <div>
                    </div>

                    <div class="container" style="height: 100vh; width:100vw;">
                        <h2 class="app">Applications</h2>
                        <!-- <h4 style="text-align: center; color: black;">Connected applications </h4> -->
                        <a href="/user/myapps" style="text-align: center; font-weight: 0px; font-size: 14px;">Add
                            More Apps <i class="fa fa-angle-right"></i></a>
                        <span class="set_as_default" style="cursor: pointer">
                            <a style="text-align: center; font-weight: 0px; font-size: 11px;">Set default app</a>
                        </span>
                        <!-- <p>Set default app</p> -->
                        <div class="row fst_dd" style="margin-top: 3%;">

                        </div>
                        <!-- <div class="row" align="center" >
                                        <div class="col-md-12" style="position: absolute; bottom: 0;">
                                        <a href="/user/myapps">Add More Apps<i class="fa fa-angle-right"></i></a>
                                        </div>
                                    </div> -->
                    </div>



                    <!-- <div class="container">
                                        <div class="row">

                                        <div class="col-md-2" data-tooltip="Social">
                                        <li class="dd"><a style="position: relative;right: 20%;" href="../workgroup" class="get_comp_list" id="themodli_" data="feeds"><span class="image">
                                        <img src="../files/images/icons/feeds_icon.png" alt=""></span>     <span>        <div class="abbrv"><span class="hide_hover">Social</span></div></span>   </a></li></div>

                                                <div class="col-md-2" data-tooltip="Social">
                                                <li class="dd"><a style="position: relative;right: 20%;" href="../workgroup" class="get_comp_list" id="themodli_" data="feeds"><span class="image">
                                                <img src="../files/images/icons/feeds_icon.png" alt=""></span>     <span>        <div class="abbrv"><span class="hide_hover">Social</span></div></span>   </a></li></div>

                                                <div class="col-md-2" data-tooltip="Social">
                                                <li class="dd"><a style="position: relative;right: 20%;" href="../workgroup" class="get_comp_list" id="themodli_" data="feeds"><span class="image">
                                                <img src="../files/images/icons/feeds_icon.png" alt=""></span>     <span>        <div class="abbrv"><span class="hide_hover">Social</span></div></span>   </a></li></div>

                                                <div class="col-md-2 " data-tooltip="Social">
                                                <li class="dd"><a style="position: relative;right: 20%;" href="../workgroup" class="get_comp_list" id="themodli_" data="feeds"><span class="image">
                                                <img src="../files/images/icons/feeds_icon.png" alt=""></span>     <span>        <div class="abbrv"><span class="hide_hover">Social</span></div></span>   </a></li></div>

                                                <div class="col-md-2 " data-tooltip="Social">
                                                <li class="dd"><a style="position: relative;right: 20%;" href="../workgroup" class="get_comp_list" id="themodli_" data="feeds"><span class="image">
                                                <img src="../files/images/icons/feeds_icon.png" alt=""></span>     <span>        <div class="abbrv"><span class="hide_hover">Social</span></div></span>   </a></li></div>

                                                <div class="col-md-2" data-tooltip="Social">
                                                <li class="dd"><a style="position: relative;right: 20%;" href="../workgroup" class="get_comp_list" id="themodli_" data="feeds"><span class="image">
                                                <img src="../files/images/icons/feeds_icon.png" alt=""></span>     <span>        <div class="abbrv"><span class="hide_hover">Social</span></div></span>   </a></li></div>
                                        </div>
                                    </div> -->


                    <!-- <div class="container" style="position: relative;top: 20%">
                                    </div> -->
                    <!-- <div class="container">
                                        <a href="/user/myapps">Add More Apps<i class="fa fa-angle-right"></i></a>
                                    </div> -->
                    <!--  <div class="container" style="margin-left: 60px; display: flex; justify-content: center;align-items:center; position: absolute; bottom: 5%;">
                                        <a href="/user/myapps">Add More Apps<i class="fa fa-angle-right"></i></a>
                                    </div>
                                    <div class="container" style="margin-left: 60px; display: flex; justify-content: center;align-items:center; position: absolute; bottom: 5%;">
                                        <a href="/user/myapps">Add More Apps<i class="fa fa-angle-right"></i></a>
                                    </div> -->
                    <div class="container" style="">
                        <div class="col-md-12">
                            <li>
                                <!-- <a href="/user/myapps">Add More Apps<i class="fa fa-angle-right"></i></a> -->
                            </li>
                        </div>
                    </div>
                </div>
            </div>
            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <nav>
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false" id="username">
                                    <img src="" alt="" id="profile_img"><span class=" fa fa-angle-down"></span>

                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right" id="user_list">

                                    <li style="background-color: ">
                                        <a onclick="window.location.href = site_url+'/user/myprofile'">
                                            <i class="fa fa-pencil pull-right"></i><b id="user_name"></b>
                                        </a>
                                    </li>


                                    <li><a onclick="window.location.href = site_url+'/user/change_password'">Change
                                            Password</a></li>
                                    <li><a
                                            onclick="function hi(){ localStorage.clear(); window.location.href = site_url}; hi();"><i
                                                class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                    <!-- <img style="display:none;"
                    onload="show_login_status('Google', true)"
                    onerror="show_login_status('Google', false)"
                    src="https://accounts.google.com/CheckCookie?continue=https%3A%2F%2Fwww.google.com%2Fintl%2Fen%2Fimages%2Flogos%2Faccounts_logo.png&followup=https%3A%2F%2Fwww.google.com%2Fintl%2Fen%2Fimages%2Flogos%2Faccounts_logo.png&chtml=LoginDoneHtml&checkedDomains=youtube&checkConnection=youtube%3A291%3A1"
                    /> -->

                                </ul>
                            </li>

                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"
                                    aria-expanded="false" onclick="openNav()">
                                    <i class="fa fa-th fa-3x"></i>
                                    <!-- <span class="badge bg-green">0</span> -->
                                </a>
                                <!-- <ul id="menu1" class="dropdown-menu list-unstyled msg_list fst_dd" role="menu">
                                    <li class="">
                                        <a id="feed_tg" href="../feeds">
                                            <span class="image"><img src="../files/images/icons/feeds_icon.png" alt=""></span>
                                            <span>
                          <span><b>Feeds</b></span>

                                            </span>
                                            <span class="message">
                          Notifications Feeds
                        </span>
                                        </a>
                                    </li>
                                </ul> -->
                            </li>

                            <!--  <li role="presentation" class="dropdown">
         

                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false" onclick="openNav()">
                                    <i class="fa fa-th fa-3x"></i>
                                </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list fst_dd" role="menu">
                    
                    <li class="">
                      <a id="feed_tg" href="">
                        <span class="image"><img src="../files/images/icons/feeds_icon.png" alt=""></span>
                        <span>
                          <span><b>Feeds</b></span>
                          
                        </span>
                        <span class="message">
                          Notifications Feeds
                        </span>
                      </a>
                    </li> -->


                            <!-- <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
      

                  
                  </ul>
                </li> -->

                            <!-- <li role="presentation">
                    <a href="/user/modules" class="dropdown-toggle info-number" >
                      <i class="fa fa-arrow-circle-left fa-3x text-center" style="font-size: 20px;"></i>
                      
                    </a>
                  </li> -->

                            <!-- <li role="presentation">
                    <a href="/user/modules">
                      <i class="fa fa-home fa-3x" style="font-size: 20px;"></i>
                    </a>
                    
                  </li> -->
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <div class="modal fade" id="modal_choose_company" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h3 class="modal-title mdl_hdn" id="exampleModalLabel" style="color: #fff;">-
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </h3>

                        </div>
                        <div class="modal-body">
                            <h4 id="list_comp_tables">Team Member Added Successfully!</h4>
                            <span id="list_comp_tables2"></span>
                        </div>
                        <!-- <div class="modal-footer"> -->
                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                        <!-- </div> -->
                    </div>
                </div>
            </div>