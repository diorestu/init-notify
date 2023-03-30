@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center row-eq-height">
            <div class="col-md-7">
                <div class="card mb-3">
                    <div class="card-header">{{ __('API Pengguna') }}</div>

                    <div class="card-body">
                        <code>
                            <p>
                                APP KEY: {{ $data }}
                            </p>
                            <p>
                                1- Add the bot to the group.
                                Go to the group, click on group name, click on Add members, in the searchbox search for your
                                bot
                                like this: @my_bot, select your bot and click add.
                            </p>

                            2- Send a dummy message to the bot.
                            You can use this example: /my_id @my_bot
                            (I tried a few messages, not all the messages work. The example above works fine. Maybe the
                            message should start with /)
                            <p>

                                3- Go to following url: https://api.telegram.org/botXXX:YYYY/getUpdates
                                replace XXX:YYYY with your bot token
                            </p>
                            <p>

                                4- Look for "chat":{"id":-zzzzzzzzzz,
                                -zzzzzzzzzz is your chat id (with the negative sign).
                            </p>
                            <p>

                                5- Testing: You can test sending a message to the group with a curl:
                            </p>
                        </code>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Pesan Terkirim</div>
                    <div class="card-body">
                        <h1>30</h1>
                    </div>
                </div>
            </div> --}}
            <div class="col-md-5">
                <div class="card mb-3">
                    <div class="card-header">{{ __('API Pengguna') }}</div>
                    <div class="card-body">
                        <code>
                            <p>Tutorial To Send Using Postman</p>
                            <strong>HTTP Request : POST</strong>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Parameter</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>app_key</th>
                                        <td>APP_KEY yang didapat dari Aplikasi</td>
                                    </tr>
                                    <tr>
                                        <th>message</th>
                                        <td>Pesan teks yang akan dikirim</td>
                                    </tr>
                                </tbody>
                            </table>
                        </code>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
