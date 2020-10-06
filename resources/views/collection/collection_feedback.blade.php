<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/favicon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    CleanApp dashboard
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="{{ asset('assets/css/material-dashboard.css?v=2.1.2') }}" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{ asset('assets/demo/demo.css') }}" rel="stylesheet" />
</head>

<body>
  

 <body>
  <div class="container">    
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="row">
          <h1>Rate Collector</h1>
          <br>
          <br>
        
          <form action="{{ route('collection_feedbacks.store') }}" method="POST" class="form-group">
            @csrf
            <ul>
              <li></li>
              <li><input type="radio" name="rating"  value="1"> &#9733; </li>
              <li><input type="radio" name="rating"  value="2"> &#9733; &#9733; </li>
              <li><input type="radio" name="rating"  value="3" checked> &#9733; &#9733; &#9733;</li>
              <li><input type="radio" name="rating"  value="4"> &#9733; &#9733; &#9733; &#9733;</li>
              <li><input type="radio" name="rating"  value="5"> &#9733; &#9733; &#9733; &#9733; &#9733;</li>
              <br>
              <label for="name">Feedback message</label>
              <input type="hidden" name="collection_id" id="collection_id" value="{{ $collection->id }}">
              <input type="hidden" name="collector_id" id="collector_id" value="{{ $collection->collector_id}}">
              <input type="text" name="feedback_message" id="feedback_message" class="form-control">
              <br>
              <button type="submit" class="btn btn-primary" class="form-control">Submit Rate</button>
            </ul>
          </form>
          
    </div>
    <div class="col-md-3"></div>
</div>
</div>
 </body>
    
  <br><br><br><br><br>

