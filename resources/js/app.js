import './bootstrap';
import 'bootstrap'; // Import Bootstrap 5 JS
import jQuery from 'jquery';

window.$ = window.jQuery = jQuery;

// Toggle Sidebar
$(document).ready(function() {
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });

    // Auto hide alerts
    $(".alert-dismissible").fadeTo(3000, 500).slideUp(500, function(){
        $(".alert-dismissible").slideUp(500);
    });
});
