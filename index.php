
<html>
	<head>
		<title>API Example</title>
		<style type="text/css">
			body{
				text-align: center;
			}
			#container{
				width: 200px;
				position:absolute;
				top:50px;
				left:50%;
				margin-left:-100px;
			}
			div{
				margin-top: 10px;
			}
			select{
				width: 90%;
			}
		</style>
	</head>
	<body>
		<div id="container">
			<h2>API Form POST</h2>
			<form method="POST" action="api/newclient">
				<div>
					<label for="google">Google:</label>
					<input type="text" name="analytics" id="google" placeholder="Google"/>
				</div>
                <div>
                    <label for="facebook">Facebook:</label>
                    <input type="text" name="facebook" id="facebook" placeholder="Facebook"/>
                </div>
				<div>
					<label for="positive">Positive:</label>
                    <br>
                    <br>
                    <select name="positive" id="positive">
                        <option value="500">LOW</option>
                        <option value="20000">HIGH</option>
                    </select>
				</div>
				<div>
					<input type="submit" value="Send" name="btn"  /> 
				</div>
			</form>					
		</div>
		</div>
	</body>
</html>