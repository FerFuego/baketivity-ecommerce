/*
 * Class General
 * @constructor
 * Created by: Fer Catalano
 */

/* Constructor */
class General {

    constructor() {
        this.init();
    }

    init() {
        this.load_listener_btns();
        this.checkTopBarPrime();
    }

    load_listener_btns() {
        var btns = document.querySelectorAll(".btn-spinner");
        if (btns.length > 0) {
            btns.forEach(function (btn) {
                btn.addEventListener("click", function () {
                    var label = btn.textContent || btn.innerText;
                    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
                    btn.style.opacity = 0.8;
                    setInterval(function () {
                        btn.innerHTML = label;
                        btn.style.opacity = 1;
                    }, 5000);
                });
            });
        }
    }

    checkTopBarPrime() {
        // Check if the user has closed the top bar before
        var topBarClosed = localStorage.getItem("topBarPrimeClosed");

        if (topBarClosed) {
            // Get the timestamp when the top bar was closed
            var closedTimestamp = parseInt(topBarClosed, 10);

            // Check if 30 minutes has passed (1800000 milliseconds in 30 minutes)
            if (Date.now() - closedTimestamp > 1800000) {
                // Remove the flag from localStorage
                localStorage.removeItem("topBarPrimeClosed");
            } else {
                // Top bar was closed within the last week, so keep it hidden
                document.getElementById("topbar-prime").style.display = "none";
            }
        }
    }

    closeTopBar() {
        // Hide the top bar
        document.getElementById("topbar-prime").style.display = "none";

        // Set a flag in local storage to remember that the top bar is closed
        localStorage.setItem("topBarPrimeClosed", Date.now().toString());
    }
}

window.addEventListener('load', () => new General());