var serialport = require("serialport");
var SerialPort = serialport.SerialPort;
var port = process.argv[2];
var read = process.argv[3];

var serialPort = new SerialPort(port, {
	baudrate: 9600,
	parser: serialport.parsers.readline("\n")
});

serialPort.on("open", function () {
	console.log('Serial Port Open');
	console.log('=================');
	serialPort.write(read, function(err) {
		if (err) {
			return console.log('Error on write: ', err.message);
		}
		console.log('message written');

		serialPort.on('data', function(data) {
			console.log('Card UID: ',data);
		});
	});
});

serialPort.on('error', function(err) {
  console.log('Error: ', err.message);
})