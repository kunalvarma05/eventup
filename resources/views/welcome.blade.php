<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>

    <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

</head>
<body>
    <div class="container">
        {!! Form::open(
            array(
                'url' => 'api',
                'class' => 'form',
                'novalidate' => 'novalidate',
                'files' => true)) !!}
                <div class="form-group">
                {!! Form::label('Image') !!}
                    {!! Form::file('file', null) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Upload') !!}
                </div>

                {!! Form::close() !!}
            </div>
        </body>
        </html>
