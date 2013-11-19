<script>
/************************************************************
 *
 * UT Cinema Inc.
 *
 * Copyright 2013. All Rights Reserved.
 * This file may not be redistributed in whole or part.
 *
 * Application: UT Cinema Web App
 * seats.php
 *
 ************************************************************/
var shapes = []; // This array hold all the objects of all classes on the canvas.
var selected_shape;

var canvas;
var context;
var x,y;

/**
 * main function to create the canvas and draw the seats.
 */
window.onload = function() {
  canvas = document.getElementById("qanvaz");

  // ...then set the internal size to match
  canvas.width  = canvas.offsetWidth;
  canvas.height = canvas.offsetHeight;
  
  context = canvas.getContext("2d");
    
  shape = [];
  canvas.onmousedown = canvasDown;
  var tableString = '<?php echo $tableString?>';
  var table = tableString.split(", ");
  var rows = 0;
  var cols = 0;
  for (var i=1;i <= <?php echo $totalSeats?>; i++) {
	if (cols > 15) {
		cols = 0;
		rows = rows + 1;
		shapes.push(new Seat(canvas,10+30*cols,10+30*rows,20,20, table.indexOf(i.toString())>-1, i));
		cols = cols+1;
	} else {
		shapes.push(new Seat(canvas,10+30*cols,10+30*rows,20,20, table.indexOf(i.toString())>-1, i));
		cols = cols + 1;
	}

  }
  context.stroke();
  drawShapes();
};var selected_seat; // The last selected shape

/**
 * react to event of clicking a seat on the canvas.
 * if seat is not taken, change its color to green, 
 * otherwise do nothing.
 */
function canvasDown(e){

    // x and y coordinates of the current position of the mouse pointer
    x = e.pageX - totalOffsetLeft(canvas); 
    y = e.pageY - totalOffsetTop(canvas);

    // Look for the clicked object.
    for(var i=shapes.length-1; i>=0; i--) {
      
        var shape = shapes[i];
          
        // If mouse is within the boundaries of an object
        // then move it to the end of the array to make it
        // the top-most shape.
        if (shape.testHit(x, y) && shape.isTaken == false) {
          deselect();
          shape.isSelected = true;
          selected_shape = shape;
          document.getElementById("submitBtn").href = "/main/creditCardPayment/" + document.getElementById("showID").value + "/" + selected_shape.id;
          drawShapes();
          return;
        }
    }
      
}

/**
 * unselect a seat.
 */
function deselect(){
    if (selected_shape != null) {
        selected_shape.isSelected = false;
        selected_shape = null;
    }
}

/**
 * Draw all the objects on the canvas that are in the array shapes. 
 */ 
function drawShapes() {
  // Clear the canvas.
  context.clearRect(0, 0, canvas.width, canvas.height);
  // Go through all the shapes.
  for(var i=0; i<shapes.length; i++) {
    var shape = shapes[i];
    shape.draw();
  }
}

/**
 * create a seat object with the position and size parameters as well as 
 * a boolean "is_taken" to tell if the seat is taken or not, and finally the id of the seat.
 */
function Seat(canvas, x, y, width, height, is_taken, id) {
      
      this.context = canvas.getContext("2d");
      // x and y coordinates, width and height
      // and the color of the rectangle
      this.x = x;
      this.y = y;
      this.width = width;
      this.height = height;
      this.isTaken = is_taken;
      this.isSelected = false;
      this.id = id;
      this.color = "yellow";
      
      this.draw = function () {
        // Draw the rectangle.
        this.context.globalAlpha = 0.85;
        this.context.beginPath();
        this.context.rect(this.x, this.y, this.width, this.height);
        
        if (this.isTaken) {
              this.color = "yellow";
            }
            else if (this.isSelected){
              this.color = "green";
            } else {
                this.color = "white";
            }
        this.context.fillStyle = this.color;
        this.context.strokeStyle = "red";
        this.context.fill();
        this.context.stroke();
        
      };
      
      // Test whether mouse is clicked within rectangle or outside.
      this.testHit = function(testX,testY) {
        if (this.x <= testX && this.x + this.width >= testX && (this.y <= testY) && this.y + this.height >= testY) {
          return true;
        }
        return false;
      };

};

/**
 * helper to get coordinates of mouse pointer. 
 */
function totalOffsetLeft(element){
    var offset = element.offsetLeft;
    while (element = element.offsetParent){
            offset += element.offsetLeft;
        } ;
    return offset;
};

/**
 * helper to get coordinates of mouse pointer. 
 */
function totalOffsetTop(element){
    var offset = element.offsetTop;
    while (element = element.offsetParent){
            offset += element.offsetTop;
        } ;
    return offset;
};
</script>
<div>
    <h1>Pick your seat</h1>
    <canvas class="paintcanvas" id="qanvaz" width="500" height="500"></canvas><br>
    <input type="hidden" id="showID" value="<?php echo $showID; ?>">
    <a class="button" id="submitBtn" href="/">Submit</a>
</div>

