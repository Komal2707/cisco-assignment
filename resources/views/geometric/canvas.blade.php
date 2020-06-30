<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drawing with canvas</title>
    <script src="https://d3js.org/d3.v5.min.js"></script>
</head>

<body>
    <div class="container">
        <div id="canvas"></div>
    </div>

    <script>
        (function () {
            //Make an SVG Container
            var svgContainer = d3.select(".container").append("svg")
                .attr("width", 500)
                .attr("height", 500);

            //Draw the Rectangle
            var rectangle = svgContainer.append("rect")
                .attr("x", (250 - 50))
                .attr("y", (250 - 50))
                .attr("fill-opacity", 0)
                .attr('stroke', '#000000')
                .attr("width", 100)
                .attr("height", 100)
                .attr("transform", "rotate(-45 250 250)");

            //Draw the Circle
            var circle = svgContainer.append("circle")
                .attr("cx", 250)
                .attr("cy", 250)
                .attr("fill-opacity", 0)
                .attr('stroke', '#000000')
                .attr("r", 100);

            //Draw the Hexagon
            scaleX = d3.scaleLinear()
                .domain([-30, 30])
                .range([0, 600]),

                scaleY = d3.scaleLinear()
                    .domain([0, 50])

            poly = [
                { "x": 300, "y": 150 },
                { "x": 225, "y": 280 },
                { "x": 75, "y": 280 },
                { "x": 0, "y": 150 },
                { "x": 75, "y": 20 },
                { "x": 225, "y": 20 }
            ];

            var adjustment = 100

            svgContainer.selectAll("polygon")
                .data([poly])
                .enter().append("polygon")
                .attr("points", function (d) {
                    return d.map(function (d) {
                        return [d.x + adjustment, d.y + adjustment].join(",");
                    }).join(" ");
                })
                .attr("fill-opacity", 0)
                .attr('stroke', '#000000')
        })()
    </script>
</body>

</html>