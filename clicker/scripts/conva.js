drawMiddleContent = function (inventory) {

    var width = $('#canvas').width();
    var height = $('#canvas').height();

    var stage = new Konva.Stage({
        container: 'canvas',
        width: width,
        height: height,
    });

    var layer = new Konva.Layer();
    stage.add(layer);

    var rowHeight = 1;

    for (let item of inventory) {
        if (!item.count) {
            rowHeight++;
            continue;
        }

        var imageObj = new Image();

        imageObj.onload = function () {
            for (var i = 0; i <= item.count; i++) {
                var imageObj = new Image();
                var positionX = 5 * i;
                var positionY = 5 + (i * rowHeight);
                var yoda = new Konva.Image({
                    x: positionX,
                    y: positionY,
                    image: imageObj,
                    width: 50,
                    height: 50,
                });
                console.log(positionX + ' x ' + positionY);

                layer.add(yoda);
            }
            layer.batchDraw();
        };

        imageObj.src = item.img;
        rowHeight++;
    }
    layer.batchDraw();
}