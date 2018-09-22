var express = require('express');
var bodyParser = require('body-parser');
var app = express();

app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());


app.put('/addUser', function(req,res){
	var data = req.body;
	if (data.username == undefined || data.password == undefined || data.email == undefined) {
		res.json({ status_code: -1});
	}
	else {
		res.json({ status_code: 0});
	}
});

app.post("/activateUser",function(req,res){
	var data = req.body;
	if (data.username == undefined) {
		res.json({ status_code: -1});
	}
	else {
		res.json({ status_code: 0});
	}
});

app.post("/deactivateUser",function(req,res){
	var data = req.body;
	if (data.username == undefined) {
		res.json({ status_code: -1});
	}
	else {
		res.json({ status_code: 0});
	}
});

app.get("/getUser/:username",function(req,res){
	var username = req.params.username;
	if (username == undefined) {
		res.json({ status_code: -1});
	}
	else {
		res.json({ username: username, password: "$2b$10$anLU5GKwok1Ck0Iz0Thve.FvjcnsKndakcYEsHi7c31O4NAaVq7ES", email: username+"@mail.com"});
	}
});
app.all("*",function(req,res){
	res.send("Not defined");
});
app.listen(3000, function () {
  console.log('Example app listening on port 3000!');
});