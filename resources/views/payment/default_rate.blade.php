@extends('layout.master')

@section('title')
    Default Rate
@endsection

@section('css4page')
    <style>
        .url-width {
            width: 20% !important;
        }

        .sidenav {
            height: 100%;
            width: 15%;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: whitesmoke;
            overflow-x: hidden;
            transition: 0.5s;
            padding: 10px;
            border-right: 2px solid lightgrey;
        }

        .sidenav a {
            padding: 18px 8px 18px 15px;
            text-decoration: none;
            font-size: 15px;
            font-weight: bold;
            color: black;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: blue;
        }

        .sidenav img {
            width: 30px;
            height: 30px;
            margin-right: 0;
            margin-bottom: auto;
            margin-top: auto;
            margin-left: 15px;
        }

        .sidenav p {
            font-size: 15px;
            margin: auto;
            font-weight: 400;
        }

        @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var height = document.getElementsByClassName('navbar')[0].clientHeight;
            console.log(height);
            var sidenav = document.getElementById('sidenav');
            sidenav.style.paddingTop = height + 5 + "px";
        });
    </script>
@endsection

@section('content')
    @if($type != 'Admin')
        Your account is not allowed here.
        <button onclick="goBack()">Go Back</button>

        <script>
            function goBack() {
                window.history.back();
            }
        </script>
    @else
    <div class="row">
        <div class="col-sm-2">
            <div id="sidenav" class="sidenav">
                <div class="row" style="padding-left: 5%; padding-top: 8%; display: flex">
                    <img src="<?=asset('/assets/icon/home.png');?>">
                    <a href="<?=url('/payment');?>">
                        <p>Billing Profiles</p>
                    </a>
                </div>
                <div class="row" style="padding-left: 5%; display: flex">
                    <img src="<?=asset('/assets/icon/payment.png');?>">
                    <a href="<?=url('/payment/default_rate');?>">
                        <p>Default Rates</p>
                    </a>
                </div>
                <div class="row" style="padding-left: 5%; display: flex">
                    <img src="<?=asset('/assets/icon/payment_1.png');?>">
                    <a href="<?=url('/payment/billing_rate_setting');?>">
                        <p>Billing Rate Setting & Stats</p>
                    </a>
                </div>
                <div class="row" style="padding-left: 5%; display: flex">
                    <img src="<?=asset('/assets/icon/redirect.png');?>">
                    <a href="<?=url('/payment/invoice');?>">
                        <p>Invoice & Payments</p>
                    </a>
                </div>
                <div class="row" style="padding-left: 5%; display: flex">
                    <img src="<?=asset('/assets/icon/contact.png');?>">
                    <a href="<?=url('/payment/forex');?>">
                        <p>Forex Rates</p>
                    </a>
                </div>
                <div class="row" style="padding-left: 5%; display: flex">
                    <img src="<?=asset('/assets/icon/group.png');?>">
                    <a href="<?=url('/payment/forex');?>">
                        <p>Reporting</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-10">
            <div class="" style="margin: auto !important;">
                <div class="row" style="margin-left: 0; margin-right: 0;">
                    <div class="col-sm-6">
                        <h1>Default Rates </h1>
                    </div>
                    <div class="col-sm-1 text-right">
                        <a class="btn btn-wide btn-primary" href="#" id="id-create"><i class="fa fa-plus"></i> Create</a>
                    </div>
                    <div class="col-sm-1 text-right">
                        <a class="btn btn-wide btn-primary" href="#" id="id-refresh"><i class="fa fa-refresh"></i> Refresh</a>
                    </div>
                    <div class="col-sm-1 text-right">
                        <a class="btn btn-wide btn-primary" href="#" id="id-export"><i class="fa fa-save"></i> Export</a>
                    </div>
                </div>
                <div class="row" style="margin-left: 0; margin-right: 0;">
                    <table class="table table-striped table-hover" id="billing-table" style="width: 98%; margin: auto;">
                        <thead>
                        <tr>
                            <th class="">#</th>
                            <th class="">Rate Type</th>
                            <th class="">Rate Name</th>
                            <th class="">Description</th>
                            <th class="">Country</th>
                            <th class="">Currency</th>
                            <th class="">Rate Per Click</th>
                            <th class="">Monthly Threshold</th>
                            <th class="">Edit/Detail</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

        <div class="modal fade in" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="Quiz" aria-hidden="true">
            <form method="post" enctype="multipart/form-data" id="id-user-form" action="/rate/create">
                {{csrf_field()}}
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="cursor: move">
                            <button type="button" class="close" style="color: black !important;" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                            <h4 class="modal-title" id="id-modal-title"></h4>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label" for="id-ratetype"> Rate Type: </label>
                                <input type="text" class="form-control" id="id-ratetype" name="ratetype" list="rate_type" required="true">
                                <datalist id="rate_type">
                                    @foreach ($rate as $per_rate)
                                        <option value="{{$per_rate -> rate_type}}"></option>
                                    @endforeach
                                </datalist>
                                <label class="control-label" for="id-ratename"> Rate Name: </label>
                                <input type="text" class="form-control" id="id-ratename" name="ratename" list="rate_name" required="true">
                                <datalist id="rate_name">
                                    @foreach ($rate as $per_rate)
                                        <option value="{{$per_rate -> rate_name}}"></option>
                                    @endforeach
                                </datalist>
                                <label class="control-label" for="id-description"> Description: </label>
                                <input type="text" class="form-control" id="id-description" name="description"  required="true">
                                <label class="control-label" for="id-country"> Country: </label>
                                <input type="text" class="form-control" id="id-country" name="country"  required="true">
                                <label class="control-label" for="sel-currency"> Currency: </label>
                                <select class="form-control custom-select" name="currency" id="sel-currency">
                                    <option value="AUD">AUD</option>
                                    <option value="USD">USD</option>
                                    <option value="EUR">EUR</option>
                                    <option value="NZD">NZD</option>
                                    <option value="CNY">CNY</option>
                                    <option value="CAD">CAD</option>
                                    <option value="GBP">GBP</option>
                                    <option value="JPY">JPY</option>
                                </select>
                                <label class="control-label" for="id-per-click" style="display: flex"> Rate Per Click (<p class="curr">$</p>) : </label>
                                <input type="text" class="form-control" id="id-per-click" name="rateperclick" placeholder="$0.00"  required="true">
                                <label class="control-label" for="id-monthly" style="display: flex"> Monthly Threshold (<p class="curr">$</p>): </label>
                                <input type="text" class="form-control" id="id-monthly" name="monthlythreshold" placeholder="$1000"  required="true">
                                <input type="hidden" id="id-rate" name="rate_id" value="0">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn-o" data-dismiss="modal" id="cancel-modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary" id="id-btn-submit">
                                Create
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
@endsection

@section('js4event')
    <script>
        jQuery(document).ready(function() {
            var usertable = $("#billing-table").DataTable({
                "ajax": {
                    url: "<?=url('/get/all-rate');?>"
                },
                processing: true,
                serverSide: true,
                pageLength: 25,
                lengthMenu: [5, 25, 50, 100],
                language: {
                    "search": "Filter Search: "
                },
                columns: [
                    {name: "no", data: "no", defaultContent: "", orderable: false},
                    {name: "rate_type", data: "rate_type", defaultContent: ""},
                    {name: "rate_name", data: "rate_name", defaultContent: ""},
                    {name: "description", data: "description", defaultContent: ""},
                    {name: "country", data: "country", defaultContent: ""},
                    {name: "currency", data: "currency", defaultContent: ""},
                    {name: "rate_per_click", data: "rate_per_click_symbol", defaultContent: ""},
                    {name: "monthly_threshold", data: "monthly_threshold_symbol", defaultContent: ""},
                    {
                        name: "tools",
                        data: "no",
                        defaultContent: "",
                        render: dt_Render_rate,
                        "className": "editCell center"
                    }
                ],
                order: [[1, 'asc']]
            });

            usertable.on("draw.dt", function () {
                $("a[type=delete-url]").off("click").on("click", function () {
                    var url_id = $(this).attr('url-id');
                    showConfirmMessage(null, "Delete Default Rate", "Are you sure you want to remove current rate", null, null, function () {
                        console.log(url_id);
                        $.ajax({
                            type: 'post',
                            url: '<?=url('/rate/delete')?>',
                            data: {
                                store_id: url_id
                            },
                            dataType: "json",
                            success: function (response) {
                                if (response.status == "ok") {
                                    usertable.draw();
                                } else if (response.status == "fail") {
                                    toastr.error(response.msg);
                                }
                            },
                            error: function () {
                                toastr.error('Server connection error');
                            }
                        });
                    });
                });

                $("a[type=deactive-url]").off("click").on("click", function () {
                    var url_id = $(this).attr('url-id');
                    showConfirmMessage(null, "Deactive Default Rate", "Are you sure you want to deactive current billing profile", null, null, function () {
                        $.ajax({
                            type: 'post',
                            url: '<?=url('/rate/active')?>',
                            data: {
                                store_id: url_id,
                                active: 'DeActive'
                            },
                            dataType: "json",
                            success: function (response) {
                                if (response.status == "ok") {
                                    usertable.draw();
                                } else if (response.status == "fail") {
                                    toastr.error(response.msg);
                                }
                            },
                            error: function () {
                                toastr.error('Server connection error');
                            }
                        });
                    });
                });

                $("a[type=active-url]").off("click").on("click", function () {
                    event.preventDefault();
                    var url_id = $(this).attr('url-id');
                    showConfirmMessage(null, "Active Default Rate", "Are you sure you want to Active current billing profile", null, null, function () {
                        $.ajax({
                            type: 'post',
                            url: '<?=url('/rate/active')?>',
                            data: {
                                store_id: url_id,
                                active: 'Active'
                            },
                            dataType: "json",
                            success: function (response) {
                                if (response.status == "ok") {
                                    usertable.draw();
                                } else if (response.status == "fail") {
                                    toastr.error(response.msg);
                                }
                            },
                            error: function () {
                                toastr.error('Server connection error');
                            }
                        });
                    });
                });

                $("#id-refresh").off("click").on("click", function() {
                    usertable.draw();
                });

                $("#id-export").off("click").on("click", function() {
                    window.location = "<?=url('/payment/default_rate/report')?>";
                });

                $("a[type=more-url]").off("click").on("click", function() {
                    var url_id = $(this).attr('url-id');
                    $.ajax({
                        type: 'post',
                        url: '<?=url('/rate/getone')?>',
                        data: {
                            rate_id: url_id,
                        },
                        dataType: "json",
                        success: function (response) {
                           let data = response.result;
                           $('#id-ratetype').val(data.rate_type);
                           $('#id-ratename').val(data.rate_name);
                           $('#id-description').val(data.description);
                           $('#id-country').val(data.country);
                           $('#sel-currency').val(data.currency);
                           $('#id-per-click').val(data.rate_per_click);
                           $('#id-monthly').val(data.monthly_threshold);
                           $('#id-rate').val(data.id);
                           $('#id-btn-submit').text("Save");
                           let currency = {"AUD":"$","USD":"$","EUR":"€","NZD":"$","CNY":"¥","CAD":"$","GBP":"£","JPY":"¥"};
                           $('.curr').html(currency[data.currency]);
                           $('#create-modal').css('display', 'block');
                            $('.modal').modal({ keyboard: false,
                                show: true
                            });
                            $('.modal-content').draggable({
                                handle: ".modal-header"
                            });
                        },
                        error: function () {
                            toastr.error('Server connection error');
                        }
                    });
                });
            });

            $('#id-create').on("click", function (event) {
                $('#id-ratetype').val("");
                $('#id-ratename').val("");
                $('#id-description').val("");
                $('#id-country').val("");
                $('#sel-currency').val("AUD");
                $('#id-per-click').val("");
                $('#id-monthly').val("");
                $('#id-btn-submit').text("Create");
                $('.curr').html("$");
                $('#id-rate').val(0);
                $('#create-modal').css('display', 'block');
                $('.modal').modal({ keyboard: false,
                    show: true
                });
                // Jquery draggable
                $('.modal-content').draggable({
                    handle: ".modal-header"
                });
            });

            $('#cancel-modal').on("click", function (event) {
                $('#create-modal').css('display', 'none');
            });

            $('.close').on("click", function (event) {
                $('#create-modal').css('display', 'none');
            });

            $('#sel-currency').on("change",function () {
                let val = $('#sel-currency').val();
                let currency = {"AUD":"$","USD":"$","EUR":"€","NZD":"$","CNY":"¥","CAD":"$","GBP":"£","JPY":"¥"};
                $('.curr').html(currency[val]);
                $('#id-per-click').attr("placeholder", currency[val]+"0.00");
                $('#id-monthly').attr("placeholder", currency[val]+"1000");
            })
        });
    </script>
@endsection

@section('js4page')
    <script src="<?=asset('bower_components/sweetalert/dist/sweetalert.min.js');?>"></script>
    <script src="<?=asset('bower_components/DataTables/media/js/jquery.dataTables.min.js');?>"></script>
    <script src="<?=asset('bower_components/DataTables/media/js/dataTables.bootstrap.min.js');?>"></script>
@endsection
