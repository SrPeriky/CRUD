<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<!-- css bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script>
		var base_url = '<?php echo BASE_URL; ?>';
	    var _gaq = _gaq || [];
	     _gaq.push(['_setAccount', 'UA-23019901-1']);
	     _gaq.push(['_setDomainName', "bootswatch.com"]);
	       _gaq.push(['_setAllowLinker', true]);
	     _gaq.push(['_trackPageview']);

	    (function() {
	      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	    })();
    </script>  
	<!-- fontawesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- VueJS @2 -->
	<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
	<!-- jquery -->
	<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
	<!-- toastr -->
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>css/toastr.min.css">
	<script type="text/javascript" src="<?php echo BASE_URL; ?>js/toastr.min.js"></script>
</head>
<body>
