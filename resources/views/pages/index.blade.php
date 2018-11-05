<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Url minification</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <script type="text/javascript" src="{{ asset('js/ajax.js') }}"></script>
</head>
<body>
<header class="navbar navbar-dark bg-dark">
    <div class="container">
        <h3 class="text-white m-0">Url Minification</h3>
    </div>
</header>
<div class="container">
    <div class="w-50 m-auto">
        <form id="url_form" class="mt-lg-5">
            <input type="text" class="form-control" name="base_url" id="base_url" placeholder="Enter you url">
            <label id="base_url-error" class="error mb-0 text-danger ml-1" for="base_url"></label>

            <div class="form-row">
                <div class="col-md-6">
                    <div class="custom-control form-control-lg custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="is_custom_link" name="is_custom_link"
                               onchange="document.getElementById('short_url').disabled = !this.checked; document.getElementById('short_url-error').textContent = '';">
                        <label class="custom-control-label noselect" for="is_custom_link">Custom</label>
                    </div>
                    <input type="text" class="form-control" name="short_url" id="short_url"
                           placeholder="Enter custom url" disabled>
                    <label id="short_url-error" class="error mb-0 text-danger ml-1" for="short_url"></label>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="custom-control form-control-lg custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="is_expired_date" id="is_expired_date"
                               onchange="document.getElementById('expired_date').disabled = !this.checked;">
                        <label class="custom-control-label noselect" for="is_expired_date">Expired date</label>
                    </div>
                    <select class="form-control" name="expired_date" id="expired_date" disabled>
                        @foreach ($postpones as $key => $postpone)
                            <option value="{{$key}}">{{$postpone}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <input type="submit" class="btn btn-dark w-100" name="submit" value="Submit">

        </form>

        <div id="test"></div>

        <div class="form-group mt-5" id="results_info_block" style="display: none">
            <label for="1">Minificated url</label>
            <input type="text" class="form-control mb-3 pg-primary-light" id="result_short_url" readonly
                   onClick="this.select();">

            <label for="1">Statistic url</label>
            <input type="text" class="form-control pg-primary-light" id="result_statistic_url" readonly
                   onClick="this.select();">
        </div>
        <div class="form-group mt-5" id="results_error_block" style="display: none">
            <div class="alert alert-danger" id="result_error"></div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script type="text/javascript" src="{{ asset('js/validate.js') }}"></script>
</body>
</html>