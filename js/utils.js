$(document).ready(function() {
    //function to format a JS date to YYYY-MM-DD format
    formatDate = function(date) {
        return date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
    };

    displayAlert = function(alertType, alertText) {
        if (alertType === "danger") {
            $("#alert-holder").html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="glyphicon glyphicon-remove-sign"></span>&nbsp' + alertText + '</div>');
        }
        else if (alertType === "success") {
            $("#alert-holder").html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="glyphicon glyphicon-ok-sign"></span>&nbsp' + alertText + '</div>');
        }
        else if (alertType === "warning") {
            $("#alert-holder").html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="glyphicon glyphicon-warning-sign"></span>&nbsp' + alertText + '</div>');
        }
        else if (alertType === "info") {
            $("#alert-holder").html('<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="glyphicon glyphicon-info-sign"></span>&nbsp' + alertText + '</div>');
        }
    };
});

