<html>
<head>
<script language="javascript">

function echeck(str) {

                var at="@"
                var dot="."
                var lat=str.indexOf(at)
                var lstr=str.length
                var ldot=str.indexOf(dot)
                if (str.indexOf(at)==-1){
                   alert("Invalid E-mail ID")
                   return false;
                }

                if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
                   alert("Invalid E-mail ID")
                   return false;
                }

                if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
                    alert("Invalid E-mail ID")
                    return false;
                }

                 if (str.indexOf(at,(lat+1))!=-1){
                    alert("Invalid E-mail ID")
                    return false;
                 }

                 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
                    alert("Invalid E-mail ID")
                    return false;
                 }

                 if (str.indexOf(dot,(lat+2))==-1){
                    alert("Invalid E-mail ID")
                    return false;
                 }

                 if (str.indexOf(" ")!=-1){
                    alert("Invalid E-mail ID")
                    return false;
                 }

                 return true;
        }

function ValidateForm(){
        var emailID=document.f1.email

        if(document.f1.firstname.value=="")
        {
                alert("Please Enter your FirstName");
                document.f1.firstname.focus();
                return false;
        }

        if(document.f1.lastname.value=="")
        {
                alert("Please Enter your LastName");
                document.f1.lastname.focus();
                return false;
        }

        if ((emailID.value==null)||(emailID.value=="")){
                alert("Please Enter your Email ID")
                emailID.focus()
                return false;
        }
        if (echeck(emailID.value)==false){
                emailID.value=""
                emailID.focus()
                return false;
        }



        return true;
 }
 
 
</script>
</head>
<title>Admin Login</title>
<style>
*{ FONT-SIZE: 8pt; FONT-FAMILY: verdana; } b { FONT-WEIGHT: bold; } .listtitle { BACKGROUND: #e45353; COLOR: #EEEEEE; white-space: nowrap; } td.list { BACKGROUND: #EEEEEE; white-space: nowrap; } </style>

<body onLoad="document.form.username.focus();">
<center><br><br><br><br>
<h1>Login Page</h1>
<table cellspacing=1 cellpadding=5>
<tr>
<td class=listtitle colspan=2>Please enter your Username and Password</td></tr>
<form id="loginForm" name="loginForm" method="post" action="login_exec.php">
<input type=hidden name=referer value="/CMD&#95LOGIN">
<tr><td class=list align=right>Username:</td><td class=list><input type=text name=username></td></tr>
<tr><td class=list align=right>Password:</td><td class=list><input type=password name=password></td></tr>
<tr><td class=listtitle align=right colspan=2><input type=submit value='Login'></td></tr>
</form>
</table>
</center></body></html>
