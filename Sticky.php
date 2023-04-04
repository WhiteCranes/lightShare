<!DOCTYPE html>
<html>

<head>
	<title>Chat Page</title>
	<meta charset="UTF-8">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.5"> -->
	<script type="text/javascript">
		function copyH5Content(index) {
			var h5Tags = document.getElementsByTagName("h4");
			var h5Tag = h5Tags[index - 1];
			var content = h5Tag.innerHTML;
			console.log(content);
			const input = document.createElement('input');
			input.value = content;
			document.body.appendChild(input);
			input.select();
			document.execCommand('copy');
			document.body.removeChild(input);

		}
	</script>
	<style type="text/css">
		body {
			/* font-family: Arial, sans-serif;
			margin: 0;
			padding: 0; */
			height: 100%;
      width: 100%;
      margin: 0;
      padding: 0;
			overflow-y: hidden;
			overflow-x: hidden;
		}

		.top-bar {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 50px;
			background-color: #333;
			color: #fff;
			backdrop-filter: blur(5px);
			background-color: rgba(0, 0, 0, 0.5);
		}


		#chat-history {
			
			height: 100vh;
			display: flex;
			flex-direction: column;
			margin: 0;
			width: 100vw;
			flex-grow: 1;
			overflow-y: scroll;
			padding: 0px;
			background-color: #f2f2f2;
			border: 0;
			margin: 0;
			width: 100vw;
		}

		#chat-history h5 {
			margin: 0;
			background-color: pink;
		}

		#chat-history h4 {
			margin: 0;
			background-color: gray;
			font-size: 20px;
		}
		#chat-history h3 {
			margin: 0;
			background-color: green;
			font-size: 40px;
			text-align: center;
		}
		#chat-input {
			display: flex;
			align-items: center;
			padding: 10px;
			border-top: 1px solid #ccc;
			background-color: #fff;
			position: fixed;
			bottom: 30px;
			width: 75%;
  left: 50%; 
  transform: translateX(-50%); 
  backdrop-filter: blur(3px);
			background-color: rgba(0, 0, 0, 0.5);
		}

		#chat-input textarea {
			flex-grow: 1;
			resize: none;
			border: none;
			height: 60px;
			margin-right: 10px;
			background-color: transparent;
			color: white;
			font-size: 25px;
		}
		::placeholder {
  color: white;
}
		#chat-input button {
			padding: 5px 10px;
			border: none;
			background-color: #007bff;
			color: #fff;
			font-size: 16px;
			cursor: pointer;
		}
	</style>
</head>

<body>
	<div class="top-bar">
		<a href="upload.php">to cloud disk</a>
	</div>

	
		<div id="chat-history">
			<?php

	echo "<br><br><br>";
	$file = 'chat.txt';
	$content = file_get_contents($file);
	$cs = explode('------#--2-@---------', $content);

	$counter = 1;
	foreach ($cs as $c) {

		$parts = explode('------#--1-@---------', $c, 2);
		$timestamp = trim($parts[0]);
		$message = nl2br(trim($parts[1]));
		if (empty($timestamp)) continue;
		echo "<h5>".$timestamp."</h5>";
		echo '<button type="button" onclick="copyH5Content('.$counter.')">copy</button>';
		echo "<h4>".$message."</h4>";
		$counter++;
		ob_flush(); 
flush();
	}

	echo "<br><br><br><br><br><br><br><br>";
?>
		<script type="text/javascript">
	
			var chatContainer = document.getElementById('chat-history');
	
			chatContainer.scrollTop = chatContainer.scrollHeight;
		</script>
		</div>


	
	<div id="chat-input">
		<textarea id="message" placeholder="input here"></textarea>
		<button id="send">Send</button>
	</div>
	<script type="text/javascript">
		const sendButton = document.getElementById('send');
		const messageInput = document.getElementById('message');
		const chatHistory = document.getElementById('chat-history');

		sendButton.addEventListener('click', () => {
			const message = messageInput.value.trim();
			if (message.length > 0) {
				const now = new Date();
				const timestamp = now.toLocaleString('en-US', { hour12: false });
				const messageHtml = `<div><strong>${timestamp}:</strong> ${message}</div>`;
				chatHistory.insertAdjacentHTML('beforeend', messageHtml);
		
				const xhttp = new XMLHttpRequest();
				xhttp.open('POST', 'save_message.php', true);
				xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				xhttp.send(`message=${message}&timestamp=${timestamp}`);
				messageInput.value = '';
			}
		});
		chatContainer.scrollTop = chatContainer.scrollHeight;
	</script>
</body>

</html>