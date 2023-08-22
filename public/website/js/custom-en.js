function licenseFile() {
	var e = document.getElementById("trade_license_file");
	if ("" == e.value) licensefileLabel.innerHTML = "upload  file";
	else {
		var l = e.value.split("\\");
		licensefileLabel.innerHTML = l[l.length - 1]
	}
}

function isoFile() {
	var e = document.getElementById("iso_9001_file");
	if ("" == e.value) isofileLabel.innerHTML = "upload  file";
	else {
		var l = e.value.split("\\");
		isofileLabel.innerHTML = l[l.length - 1]
	}
}

function isoFile1() {
	var e = document.getElementById("iso_45001_file");
	if ("" == e.value) isofileLabel1.innerHTML = "upload  file";
	else {
		var l = e.value.split("\\");
		isofileLabel1.innerHTML = l[l.length - 1]
	}
}

function isoFile2() {
	var e = document.getElementById("iso_14001_file");
	if ("" == e.value) isofileLabel2.innerHTML = "upload  file";
	else {
		var l = e.value.split("\\");
		isofileLabel2.innerHTML = l[l.length - 1]
	}
}

function certificationsFile() {
	var e = document.querySelector('[name="equivalent_certifications_file"]');
	if ("" == e.value) equfileLabel.innerHTML = "upload  file";
	else {
		var l = e.value.split("\\");
		equfileLabel.innerHTML = l[l.length - 1]
	}
}

function licenceFile2() {
	var e = document.getElementById("licence_file");
	if ("" == e.value) licenceLabel.innerHTML = "upload  file";
	else {
		var l = e.value.split("\\");
		licenceLabel.innerHTML = l[l.length - 1]
	}
}

function formFile() {
	var e = document.getElementById("formFileLg");
	if ("" == e.value) formFileLabel.innerHTML = "upload  file";
	else {
		var l = e.value.split("\\");
		formFileLabel.innerHTML = l[l.length - 1]
	}
}

function MSDCfile() {
	var e = document.getElementById("MSDC_certificate_file");
	if ("" == e.value) MSDCfileLabel.innerHTML = "upload  file";
	else {
		var l = e.value.split("\\");
		MSDCfileLabel.innerHTML = l[l.length - 1]
	}
}

// function patientFile() {
// 	var e = document.getElementById("patient_file");
// 	if ("" == e.value) patientfileLabel.innerHTML = "upload  file";
// 	else {
// 		var l = e.value.split("\\");
// 		patientfileLabel.innerHTML = l[l.length - 1]
// 	}
// }

// function medicalReportFile() {
// 	var e = document.getElementById("medical_report_files");
// 	if ("" == e.value) reportfileLabel.innerHTML = "upload  file";
// 	else {
// 		var l = e.value.split("\\");
// 		reportfileLabel.innerHTML = l[l.length - 1]
// 	}
// }

// function supportfileFunction() {
// 	var e = document.getElementById("supportingFile");
// 	if ("" == e.value) supportFileLabel.innerHTML = "upload  file";
// 	else {
// 		var l = e.value.split("\\");
// 		supportFileLabel.innerHTML = l[l.length - 1]
// 	}
// }

function appointmentFile() {
	var e = document.getElementById("appointment_file");
	if ("" == e.value) appointmentFileLabel.innerHTML = "upload  file";
	else {
		var l = e.value.split("\\");
		appointmentFileLabel.innerHTML = l[l.length - 1]
	}
}

function admissionFile() {
	var e = document.getElementById("admission_file");
	if ("" == e.value) admissionFileLabel.innerHTML = "upload  file";
	else {
		var l = e.value.split("\\");
		admissionFileLabel.innerHTML = l[l.length - 1]
	}
}
$(".logoSlider").slick({
	slidesToShow: 5,
	slidesToScroll: 1,
	autoplay: !0,
	autoplaySpeed: 2e3,
	arrows: !1,
	dots: !1,
	pauseOnHover: !1,
	variableWidth: !1,
	responsive: [{
		breakpoint: 768,
		settings: {
			slidesToShow: 1
		}
	}, {
		breakpoint: 520,
		settings: {
			slidesToShow: 4,
			slidesToScroll: 1
		}
	}]
}), $(".bannerSlider").slick({
	slidesToShow: 1,
	slidesToScroll: 1,
	autoplay: !1,
	autoplaySpeed: 2e3,
	arrows: !0,
	dots: !1,
	pauseOnHover: !1,
	variableWidth: !1,
	responsive: [{
		breakpoint: 576,
		settings: {
			arrows: !1,
			dots: !0
		}
	}]
}), $("#bottom_scroll").click(function () {
	$(this).attr("href");
	$("html, body").animate({
		scrollTop: $("#about").offset().top
	}, 1e3)
}), $(".navbar-toggler").click(function () {
	$(this).toggleClass("close"), $("body").toggleClass("overflow"), $("#navbar_menu").toggleClass("open"), $(".header").toggleClass("mobHeader")
}), $(".searchBtn").click(function () {
	$(this).toggleClass("close"), $("#deskSearch").toggle("")
}), $(".mob_searchBtn #seacrh_icon").click(function () {
	$(this).hide("slow"), $("#mobSearch").show("slow"), $("#close_icon").show("slow")
}), $(".mob_searchBtn #close_icon").click(function () {
	$(this).hide("slow"), $("#mobSearch").hide("slow"), $("#seacrh_icon").show("slow")
}), $(document).ready(function () {
	$("#homeSlider").carousel({
		interval: !1
	}), $(window).width() < 992 ? ($("#submenu").hide(), $(".header .navbar-nav li.dropdownMenu a.nav-link").click(function () {
		event.preventDefault(), $(this).parent().find("#submenu").slideToggle("slow"), $(this).toggleClass("menuOpen")
	})) : $("#submenu").show(), $(window).width() < 992 ? ($("#menuLevel2").hide(), $(".header .navbar-nav li.subNav a.subLink").click(function () {
		event.preventDefault(), $(this).parent().find("#menuLevel2").slideToggle("slow"), $(this).toggleClass("expandLink")
	})) : $("#menuLevel2").show(), $(window).resize(function () {
		$(window).width() < 992 ? ($(".mega_menu").hide(), $(".dropdown .fas").click(function () {
			event.preventDefault(), $(this).parent().find(".mega_menu").slideToggle("slow"), $(this).toggleClass("fa-minus")
		})) : $(".mega_menu").show()
	})
}), $(".menuSidebar .sidebarNav li").hasClass("dropdown") ? ($(".sidebarDropdown").hide(), $(".dropdown-link").click(function () {
	event.preventDefault(), $(this).parent().find(".sidebarDropdown").slideToggle("slow"), $(this).toggleClass("open")
})) : $(".sidebarDropdown").show(), $(window).scroll(function () {
	$(window).scrollTop() >= 150 ? $(".header").addClass("sticky_header") : $(".header").removeClass("sticky_header")
}), $(window).scroll(function () {
	$(this).scrollTop() > 500 ? $(".scroll-top").fadeIn() : $(".scroll-top").fadeOut()
}), $(".scroll-top").click(function () {
	return $("html, body").animate({
		scrollTop: 0
	}, 100), !1
}), $(window).scroll(function () {
	(new WOW).init()
}), $(document).ready(function () {
	$(".filter-button").click(function () {
		var e = $(this).attr("data-filter");
		"all" == e ? $(".filter").show("1000") : ($(".filter").not("." + e).hide("3000"), $(".filter").filter("." + e).show("3000")), $(".filter-button").removeClass("active") && $(this).removeClass("active"), $(this).addClass("active")
	})
}), $(".newsSlider").slick({
	slidesToShow: 1,
	slidesToScroll: 1,
	autoplay: !1,
	autoplaySpeed: 2e3,
	arrows: !0,
	dots: !1,
	pauseOnHover: !1,
	variableWidth: !1
}), 
$(".testimonialSlider").slick({
	slidesToShow: 2,
	slidesToScroll: 1,
	autoplay: !1,
	autoplaySpeed: 2e3,
	arrows: !1,
	dots: !0,
	pauseOnHover: !1,
	variableWidth: !1
})

if ($('.testimonialSlider .testimonials_item').length == 1) {
	$('.testimonialSlider').slick('unslick');
  }
 
patientFile = function() {
    for (var e = document.getElementById("patient_file"), n = document.getElementById("fileList"), 
    t = "", 
    i = 0; 
    i < e.files.length; ++i) t += "<li>" + e.files.item(i).name + '<span class="remove-list" onclick="return this.parentNode.remove()">&#10006;</span>' + "</li>";
    n.innerHTML = '<ul class="file_list">' + t + "</ul>"
}

medicalReportFile = function() {
    for (var e = document.getElementById("medical_report_files"), n = document.getElementById("rptfileList"), 
    t = "", 
    i = 0; 
    i < e.files.length; ++i) t += "<li>" + e.files.item(i).name + '<span class="remove-list" onclick="return this.parentNode.remove()">&#10006;</span>' + "</li>";
    n.innerHTML = '<ul class="file_list">' + t + "</ul>"
}

supportfileFunction = function() {
    for (var e = document.getElementById("supportingFile"), n = document.getElementById("supportFilelist"), 
    t = "", 
    i = 0; 
    i < e.files.length; ++i) t += "<li>" + e.files.item(i).name + '<span class="remove-list" onclick="return this.parentNode.remove()">&#10006;</span>' + "</li>";
    n.innerHTML = '<ul class="file_list">' + t + "</ul>"
}

passportFiles = function() {
    for (var e = document.getElementById("passport_files"), n = document.getElementById("psportfilesList"), 
    t = "", 
    i = 0; 
    i < e.files.length; ++i) t += "<li>" + e.files.item(i).name + '<span class="remove-list" onclick="return this.parentNode.remove()">&#10006;</span>' + "</li>";
    n.innerHTML = '<ul class="file_list">' + t + "</ul>"  
}
 