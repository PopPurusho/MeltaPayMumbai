<link href="{{ asset('css/tailwind/app.css?v='.$asset_v) }}" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/vendor.css?v='.$asset_v) }}">

@if( in_array(session()->get('user.language', config('app.locale')), config('constants.langs_rtl')) )
	<link rel="stylesheet" href="{{ asset('css/rtl.css?v='.$asset_v) }}">
@endif

@yield('css')

<!-- app css -->
<link rel="stylesheet" href="{{ asset('css/app.css?v='.$asset_v) }}">

{{-- Pure-CSS override for iCheck sprite-based checkboxes.
     iCheck hides native <input> (opacity:0) and wraps it in a
     <div class="icheckbox_square-blue"> that displays a sprite image.
     If the sprite fails to load the div is invisible.  These rules
     render the checkbox with CSS only — zero image dependency. --}}
<style>
.icheckbox_square-blue,
.iradio_square-blue {
    background-image: none !important;
    background: #fff !important;
    border: 2px solid #cbd5e1 !important;
    border-radius: 4px !important;
    width: 20px !important;
    height: 20px !important;
    display: inline-block !important;
    vertical-align: middle !important;
    position: relative !important;
    cursor: pointer !important;
    transition: background .15s, border-color .15s !important;
}
.icheckbox_square-blue.hover,
.iradio_square-blue.hover {
    border-color: #6366f1 !important;
}
.icheckbox_square-blue.checked,
.iradio_square-blue.checked {
    background: #4f46e5 !important;
    border-color: #4f46e5 !important;
}
.icheckbox_square-blue.checked::after,
.iradio_square-blue.checked::after {
    content: '\2713';
    color: #fff;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 14px;
    font-weight: 700;
    line-height: 1;
}
.iradio_square-blue {
    border-radius: 50% !important;
}
.iradio_square-blue.checked::after {
    content: '';
    width: 8px;
    height: 8px;
    background: #fff;
    border-radius: 50%;
}
.icheckbox_square-blue.disabled,
.iradio_square-blue.disabled {
    opacity: .5 !important;
    cursor: default !important;
}
</style>

@if(isset($pos_layout) && $pos_layout)
	<style type="text/css">
		.content{
			padding-bottom: 0px !important;
		}
	</style>
@endif
<style type="text/css">
	/*
	* Pattern lock css
	* Pattern direction
	* http://ignitersworld.com/lab/patternLock.html
	*/
	.patt-wrap {
	  z-index: 10;
	}
	.patt-circ.hovered {
	  background-color: #cde2f2;
	  border: none;
	}
	.patt-circ.hovered .patt-dots {
	  display: none;
	}
	.patt-circ.dir {
	  background-image: url("{{asset('img/pattern-directionicon-arrow.png')}}");
	  background-position: center;
	  background-repeat: no-repeat;
	}
	.patt-circ.e {
	  -webkit-transform: rotate(0);
	  transform: rotate(0);
	}
	.patt-circ.s-e {
	  -webkit-transform: rotate(45deg);
	  transform: rotate(45deg);
	}
	.patt-circ.s {
	  -webkit-transform: rotate(90deg);
	  transform: rotate(90deg);
	}
	.patt-circ.s-w {
	  -webkit-transform: rotate(135deg);
	  transform: rotate(135deg);
	}
	.patt-circ.w {
	  -webkit-transform: rotate(180deg);
	  transform: rotate(180deg);
	}
	.patt-circ.n-w {
	  -webkit-transform: rotate(225deg);
	   transform: rotate(225deg);
	}
	.patt-circ.n {
	  -webkit-transform: rotate(270deg);
	  transform: rotate(270deg);
	}
	.patt-circ.n-e {
	  -webkit-transform: rotate(315deg);
	  transform: rotate(315deg);
	}
</style>
@if(!empty($__system_settings['additional_css']))
    {!! $__system_settings['additional_css'] !!}
@endif

