<div class="footer">
        <div class="content">
            <p style="color: black;">Copyright &copy; 2024 Your Company. <a href="http://www.templatemo.com/tm-512-moonlight">Rumahsakit</a> by <a href="http://www.html5max.com" target="_parent">HTML5 Max</a></p>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="<?= base_url('_assets/js/vendor/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('_assets/js/datepicker.js') ?>"></script>
    <script src="<?= base_url('_assets/js/plugins.js') ?>"></script>
    <script src="<?= base_url('_assets/js/main.js') ?>"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        // Navigation click actions
        $('.scroll-link').on('click', function(event) {
            event.preventDefault();
            var sectionID = $(this).attr("data-id");
            scrollToID('#' + sectionID, 750);
        });

        // Scroll to top action
        $('.scroll-top').on('click', function(event) {
            event.preventDefault();
            $('html, body').animate({scrollTop: 0}, 'slow');         
        });

        // Mobile nav toggle
        $('#nav-toggle').on('click', function (event) {
            event.preventDefault();
            $('#main-nav').toggleClass("open");
        });
    });

    // Scroll function
    function scrollToID(id, speed) {
        var offSet = 0;
        var targetOffset = $(id).offset().top - offSet;
        var mainNav = $('#main-nav');
        $('html,body').animate({scrollTop: targetOffset}, speed);
        if (mainNav.hasClass("open")) {
            mainNav.css("height", "1px").removeClass("in").addClass("collapse");
            mainNav.removeClass("open");
        }
    }

    if (typeof console === "undefined") {
        console = { log: function() {} };
    }
    </script>

</body>
</html>