const width = 320
const height = 320
const radius = Math.min(width, height) / 2
const innerRadius = 0.3 * radius
const pie = d3.layout.pie()
  .sort(null)
  .value(function (d) { return d.width })
const tip = d3.tip()
  .attr('class', 'd3-tip')
  .offset([0, 0])
  .html(function (d) {
    return d.data.label + ': <span style="color:orangered">' + d.data.score + '</span>'
  })
const arc = d3.svg.arc()
  .innerRadius(innerRadius)
  .outerRadius(function (d) {
    return (radius - innerRadius) * (d.data.score / 100.0) + innerRadius
  })
const outlineArc = d3.svg.arc()
        .innerRadius(innerRadius)
        .outerRadius(radius)
const svg = d3.select('#graph-body').append('svg')
    .attr('width', width)
    .attr('height', height)
    .append('g')
    .attr('transform', 'translate(' + width / 2 + ',' + height / 2 + ')');

svg.call(tip)

d3.json('./data.php', function (error, data) {
  data.forEach(function(d) {
    d.id     =  d.id
    d.order  = +d.order
    d.color  =  d.color
    d.weight = +d.weight
    d.score  = +d.score
    d.width  = +d.weight
    d.label  =  d.label
  })

  const path = svg.selectAll('.solidArc')
      .data(pie(data))
    .enter().append('path')
      .attr('fill', function(d) { return d.data.color; })
      .attr('class', 'solidArc')
      .attr('stroke', 'gray')
      .attr('d', arc)
      .on('mouseover', tip.show)
      .on('mouseout', tip.hide)

  const outerPath = svg.selectAll('.outlineArc')
      .data(pie(data))
    .enter().append('path')
      .attr('fill', 'none')
      .attr('stroke', 'gray')
      .attr('class', 'outlineArc')
      .attr('d', outlineArc)
})
