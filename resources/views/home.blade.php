<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Feeds from BBC</title>

	<link rel="stylesheet" href="{{ url('css/style.css') }}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.2/react.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.2/react-dom.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.23/browser.min.js"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>
<section id="rst-popular">
			<div class="container">
				<div class="row">
					<div class="rst-section-title">
						<div class="container">
							<div class="row">
								<div class="col-xs-12">
									<h4>BBC feed stories</h4>
									<div class="center">
										<h5>This is an RSS feed from the BBC News - Home website.
											RSS feeds allow you to stay up to date with the latest news and features
											you want from BBC News - Home.</h5>
									</div>
								</div>
							</div>
						</div>
					</div>
								{{-- */$key=0;/* --}}
								@if(!empty($data))
									 @foreach($data as $feed)
									 {{-- */$key=$key+1;/* --}}
									 <article class="col-sm-3 col-xs-6">
										 <div class="rst-postinfo">
											 <?php $namespace = "http://search.yahoo.com/mrss/";
												 $image = $feed->children($namespace)->thumbnail[0]->attributes();
													$image_link = $image['url'];
													echo '<div class="rst-postpic">
																<img alt="" src="'.$image_link.'">
																</div>';
													?>
											 <h6><a href="{{$feed->link}}">{{$feed->title}}</a></h6>
											 <time><i class="fa fa-clock-o"></i>{{$feed->pubDate}}</time>
											 <p>{{$feed->description}}</p>
											 <div class="pull-right likeArea">
												 <i class="fa fa-heart" aria-hidden="true"><span>12</span></i>
												</div>

										 </div>
									 </article>
											 @if(!($key % 4) and $key > 0)
										 </div><br/>
											 <div class="row">
											 @endif
									 @endforeach
								@else
								<article class="col-sm-12 col-xs-12">
									<div class="rst-postinfo">
										<h6><a href="#">Something Went wrong !</a></h6>
										<p>{{$error}}</p>
									</div>
								</article>
								@endif
				</div>
			</div>

		</section>

	<script src="{{ url('js/bootstrap.js') }}"></script>
	<script type="text/babel" src="{{ url('js/react/error.js') }}"></script>
	<script type="text/babel" src="{{ url('js/react/monitor.js') }}"></script>
	<script type="text/babel" src="{{ url('js/react/app.js') }}"></script>
</body>
</html>
