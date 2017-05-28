<?php header('Content-type:application/json; charset=utf-8');header("Access-Control-Allow-Origin: *");header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin, Authorization");header('HTTP/1.0 404 Not Found');echo '{
  "status": "error",
  "code": "404",
  "message": "Sorry page is not found."
}';?>