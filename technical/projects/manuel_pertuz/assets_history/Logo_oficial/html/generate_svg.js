const fs = require('fs');
const TextToSVG = require('text-to-svg');

TextToSVG.load('./Allison-Regular.ttf', function(err, textToSVG) {
  if (err) {
    console.error(err);
    process.exit(1);
  }
  const attributes = {fill: '#1c1c1c'};
  const options = {x: 0, y: 0, fontSize: 180, anchor: 'top', attributes: attributes};
  
  // We apply the -3 degree rotation as requested in option 1
  let svgContent = textToSVG.getSVG('Manuel Pertuz', options);
  
  // Wrap the path in a group with transform
  svgContent = svgContent.replace('<svg ', '<svg viewBox="0 -50 800 300" ');
  svgContent = svgContent.replace('<path ', '<g transform="rotate(-3 200 100)"><path ');
  svgContent = svgContent.replace('</svg>', '</g></svg>');

  fs.writeFileSync('Firma_Manuel_Pertuz.svg', svgContent);
  console.log("SVG Generado exitosamente con texto convertido a curvas (paths).");
});
