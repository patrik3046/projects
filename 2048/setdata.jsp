<%@page language="java" contentType="text/html" pageEncoding="UTF-8" %>
<%@ page import ="java.sql.*" %>

<%
String name = request.getParameter("gameOverName");
String score = request.getParameter("gameOverScore");
String mode = request.getParameter("gameOverMode");
String mapsize = request.getParameter("gameOverMapsize");
String levelReached = request.getParameter("gameOverLevelReached");

String driverName="com.mysql.jdbc.Driver";
String url="jdbc:mysql://localhost:3306/";
String databaseName="scores";
String userName="root";
String password="";
Connection con = null;
try{
  	Class.forName(driverName);
  	con=(Connection) DriverManager.getConnection(url+databaseName, userName, password);

  	try {
	    String sql = "INSERT INTO scores VALUES(Null,'" + name + "'," + score + ",'" + mode + "','" + mapsize + "'," + levelReached + ")";
	    Statement statement = con.createStatement();
	    try {
	        statement.executeUpdate(sql);
	    } finally {
	        statement.close();
	    	}
	} finally {
	    con.close();
	}
}
catch(Exception e){
  	out.println(e);
}	
%>
<script type="text/javascript">
	window.location.href = "index.jsp";
	alert("Az eredmányek sikeresen elmentve!");
</script>