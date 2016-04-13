////////////////////////////////////////////////////////////
// IoT Lite Brite - Javascript File
//
// Written By J. Horton - 2/6/2016 v 1
//
// More info at http://johnventions.com/projects/lite-brite
///////////////////////////////////////////////////////////////

var r, g, b;
var colorCode;

function initialRefresh() {
    //This is the intitial function that runs.
    //Request the current liteBrite color grid from lb_json
    $.ajax({
            dataType: "json",
            method: "POST",
            url: "lb_json.php",
            data: null
        })
        //When you recieve it, run the JSON through the refresh function to update the browser
        .done(function(msg) {
            //console.log(msg);
            refresh(msg);

        });
}


function componentToHex(c) {
    //function to convert R, G, or B components to a hex value
    var hex = c.toString(16);
    return hex.length == 1 ? "0" + hex : hex;
}


function rgbToHex(r, g, b) {
    //function to convert all R, G, and B to a hex value
    return "#" + componentToHex(r) + componentToHex(g) + componentToHex(b);
}


function sendPixel() {
    //function to send an individual pixel update
    //Row, Column and Color info are pulled from the #pixels form
    var pixelData = $("#pixels").serialize();
    console.log(pixelData);
    //Send the updated pixel to lb_update
    $.ajax({
            dataType: "json",
            method: "POST",
            url: "lb_update.php",
            data: pixelData
        })
        //Log the error if need be
        .fail(function() {
            console.log("error");
        })
        //Ajax request returns the full grid, in case other pixels have changed
        .done(function(msg) {
            //console.log(msg);
            refresh(msg);
        });
}

function refresh(lights) {
    //lights is a json array of the individual rows and columns
    //each object in the data set has a row, col, and r/g/b value
    jQuery.each(lights, function(i, val) {
        console.log(i);
        //parse out the data
        var r = parseInt(val['r']);
        var g = parseInt(val['g']);
        var b = parseInt(val['b']);
        var newColor = rgbToHex(r, g, b);
        //update the correct box by modifying the css background color
        $("#lb_box" + val['row'] + "_" + val['col']).css("background-color", newColor);
    });
}

function light(r, c) {
    //this is the OnClick function for each box of the grid
    //update the hidden form
    $("#row").val(r);
    $("#col").val(c);
    //Send the update via the sendPixel function
    sendPixel();
    //Update the background color of this particular box
    var boxName = "#lb_box" + r + "_" + c;
    $(boxName).css("background-color", colorCode);
}

function update(picker) {
    //The update function of the color picker
    //Pull the color code from the object
    colorCode = picker.toHEXString();
    r = Math.round(picker.rgb[0]);
    g = Math.round(picker.rgb[1]);
    b = Math.round(picker.rgb[2])
        //update the hidden form to have the newest color value
    $("#r").val(r);
    $("#g").val(g);
    $("#b").val(b);
}