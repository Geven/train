<html>

<head>
<style>


</style>
    <script>
    </script>
</head>
<body><script src="http://code.jquery.com/jquery-2.0.0.js"></script>
<input type="text" placeholder="search" id="search">

<ul>
    <li class="searchable" data-index="ona">
    <dl>
        <dt>First Name</dt><dd>Ona</dd>
        <dt>Last Name</dt><dd>Bednar</dd>
        <dt>Email</dt><dd>schamberger.frank@wuckert.com</dd>
        <dt>Phone</dt><dd>1-265-479-1196x714</dd>

        </dl>
    </li>

    <li class="searchable" data-index="newton">
        <dl>
            <dt>First Name</dt><dd>Newton</dd>
            <dt>Last Name</dt><dd>Cronin</dd>
            <dt>Email</dt><dd>torphy.dorothea@gmail.com</dd>
            <dt>Phone</dt><dd>(121)644-5577</dd>
        </dl>
    </li>

    <li class="searchable" data-index="jewton">
        <dl>
            <dt>First Name</dt><dd>Jewton</dd>
            <dt>Last Name</dt><dd>Vonin</dd>
            <dt>Email</dt><dd>jewton@gmail.com</dd>
            <dt>Phone</dt><dd>(121)644-5577</dd>
        </dl>
    </li>
    <li class="searchable" data-index="tony">
        <dl>
            <dt>First Name</dt><dd>Tony</dd>
            <dt>Last Name</dt><dd>Black</dd>
            <dt>Email</dt><dd>torphy.dorothea@gmail.com</dd>
            <dt>Phone</dt><dd>(121)644-5577</dd>
        </dl>
    </li>
    <li class="searchable" data-index="isaac">
        <dl>
            <dt>First Name</dt><dd>Isaaac</dd>
            <dt>Last Name</dt><dd>Death</dd>
            <dt>Email</dt><dd>torphy.dorothea@gmail.com</dd>
            <dt>Phone</dt><dd>(121)644-5577</dd>
        </dl>
    </li>
    <li class="searchable" data-index="peter">
        <dl>
            <dt>First Name</dt><dd>Peter</dd>
            <dt>Last Name</dt><dd>Search</dd>
            <dt>Email</dt><dd>torphy.dorothea@gmail.com</dd>
            <dt>Phone</dt><dd>(121)644-5577</dd>
        </dl>
    </li>


</ul>
<style id="search_style"></style>
<script type="text/javascript">

        var searchStyle = document.getElementById("search_style");
        document.getElementById("search").addEventListener('input', function() {
            if(!this.value)
            {
                searchStyle.innerHTML = "";
                return;
            }

            searchStyle.innerHTML = ".searchable:not([data-index*=\"" +this.value.toLowerCase()+ "\"]) { display:none; }";
                }
        );


</script>

</body>
<?php




?>

</html>