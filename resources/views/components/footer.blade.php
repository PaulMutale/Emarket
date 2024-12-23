<!-- Footer Section -->
<footer class="footer-section">
		<div class="container">
			<a href="index.html" class="footer-logo">
				<h3 style="color: white;">E<span style="color:red">MARKET</span></h3>
			</a>
			<div class="row">
				<div class="col-lg-4 col-md-4">
					<div class="footer-widget">
						<p>{{__('MyEliana Market - A System which can help you to find any property or apartment for sale or rent nearby your prefered location of choice.')}}</p>
					<!--
            <ul>
							<li>{{__('Land')}}</li>
							<li>{{__('Apartments')}}</li>
							<li>{{__('Farms')}}</li>
							<li>{{__('Plots')}}</li>
							<li>{{__('Villas')}}</li>
							<li>{{__('Other Estates')}}</li>							
						</ul>
-->
					</div>
				</div>
				<div class="col-lg-4 col-md-4">
					<div class="footer-widget">
						<h2>{{__('About us')}}</h2>
						<ul>
							<li><a href="#">{{__('Home')}}</a></li>
						<!--	<li><a href="news.html">{{__('Our story')}}</a></li>-->
							<!--<li><a href="{{route('login')}}">{{__('Login')}}</a></li>-->
							<li><a href="{{route('register')}}">{{__('Sell Property')}}</a></li>
							
						</ul>
					</div>
				</div>
				
				<div class="col-lg-4 col-md-4">
					<div class="footer-widget">
						<h2>{{__('Site Info')}}</h2>
						<ul>
              <!--Documentation-->
							<li><a target="_blank" href="https://chanda-chewe.gitbook.io/estate-management-system-zm/">{{__('Support')}}</a></li> 
							<li><a href="{{route('terms')}}">{{__('Terms and Conditions')}}</a></li>
							<li><a href="mailto:support@estatezm.com">{{__('Contact Us')}}</a></li>
						</ul>
					</div>
				</div>
			</div>
			<p>MyELIANA MARKET - CLOUDBASED LISTING MANAGEMENT SYSTEM</p>
			<div class="copyright"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> {{__('All rights reserved | powered')}} <i class="fa fa-heart-o" aria-hidden="true"></i> {{__('by')}} <a href="https://www.elianaconnect.com" target="_blank"> ECONNECT</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
		</div>
	</footer>
	<!-- Footer Section end -->
	
	<!--====== Javascripts, Jquery & PopperJs ======-->
	
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="{{asset('assets/js/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/js/jquery.slicknav.min.js')}}"></script>
	<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
	<script src="{{asset('assets/js/main.js')}}"></script>

	</body>
</html>


















