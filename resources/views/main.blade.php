<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}?{{time()}}" />
  <title>
    {{
      env('APP_NAME')
    }}
  </title>
</head>
<body>
  <div id="app">
  </div>
  <script src="{{ mix('js/app.js') }}?{{time()}}"></script>
</body>
</html>