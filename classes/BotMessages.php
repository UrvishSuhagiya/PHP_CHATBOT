<?php
// classes/BotMessages.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("DB.php");
include_once("Session.php"); // Ensure correct casing if your file is Session.php

class BotMessages {
    private $db;
    private $msgSession;
    private $syllabus;
    private $patterns;

    function __construct() {
        $this->db = new DB();
        $this->msgSession = new Session();
        date_default_timezone_set('Asia/Kolkata'); // Set timezone

        // Define syllabus data
        $this->syllabus = [
            'section1' => [
                'module1' => '<b>PHP</b> : Introduction to PHP and its syntax, combining PHP and HTML, understanding PHP code blocks like Arrays, Strings, Functions, looping and branching, file handling, processing forms on server side, cookies and sessions.',
                'module2' => '<b>Object Oriented PHP </b>: Object Oriented Programming with PHP – Classes, Properties, Methods, Constructor, Destructor, Getter and Setter, Encapsulation, Inheritance, Data Abstraction, Polymorphism',
                'module3' => ' <b>Advanced PHP </b>: Web Scraping using cURL, Regular Expression, Mail function, Web Services & APIs'
            ],
            'section2' => [
                'module1' => ' <b>PHP MVC Framework-Laravel </b>: Introduction to Laravel and MVC, Environment Setup, Routes, Namespaces, Controllers, Views, Request Response, Redirections, Forms, Session, Cookie, Database Connectivity and CRUD operations',
                'module2' => ' <b>PHP & MY SQL </b>: Introduction to PHP MyAdmin, connection to MySQL server from PHP, execution of MySQL queries from PHP, receiving data from database server and processing it on webserver using PHP.',
                'module3' => ' <b>WEB SOCKETS</b> : Introduction to Web sockets, Web socket URIs, Web socket APIs, Opening Handshake, Data Framing, Sending and Receiving Data, Closing the Connections, Error Handling, Web socket Security'
            ]
        ];

        // Define pattern-response pairs
        $this->patterns = [
            // Greetings
            '/\bhello\b|\bhi\b|\bgreetings\b|\bhey\b/i' => 'Hello! How can I assist you today?',
            '/\bhow are you\b/i' => 'I\'m a bot, but I\'m functioning as expected! How about you?',
            '/\bbye\b|\bgoodbye\b/i' => 'Goodbye! Have a great day!',
            '/\bthank you\b|\bthanks\b/i' => 'You\'re welcome!',

            // Additional Positive Expressions
            '/\bgreat\b|\bwow\b|\bnice\b|\bgood\b|\bawesome\b|\bfantastic\b|\bsuper\b|\bmagnificent\b/i' => 'I\'m glad you feel that way! How can I help you further?',

            // Programming Concepts
            '/\bphp\b|\bwhat is php\b|\bdefine php\b|\bphp definition\b|\bphp programming\b/i' => 'PHP is a popular general-purpose scripting language that is especially suited to web development.',
            '/\bsession\b|\bwhat is session\b|\bdefine session\b/i' => 'A session is a way to store information (in variables) to be used across multiple pages.',
            '/\bcomposer\b|\bwhat is composer\b|\bdefine composer\b/i' => 'Composer is a dependency manager for PHP, enabling you to manage libraries and packages easily.',
            '/\barray\b|\bwhat is an array\b|\bdefine array\b/i' => 'An array is a data structure that can hold multiple values under a single name.',
            '/\bdatabase\b|\bwhat is a database\b|\bdefine database\b/i' => 'A database is an organized collection of structured information, typically stored electronically.',
            '/\bfunction\b|\bwhat is a function\b|\bdefine function\b/i' => 'A function is a block of code that performs a specific task and can be reused throughout your code.',
            '/\bvariable\b|\bwhat is a variable\b|\bdefine variable\b/i' => 'A variable is a container for storing data values.',
            '/\bloop\b|\bwhat is a loop\b|\bdefine loop\b/i' => 'A loop is a programming structure that repeats a sequence of instructions until a specific condition is met.',
            '/\bmvc\b|\bwhat is mvc\b|\bdefine mvc\b/i' => 'MVC stands for Model-View-Controller, a software architectural pattern for implementing user interfaces.',
            '/\bhtml\b|\bwhat is html\b|\bdefine html\b/i' => 'HTML stands for HyperText Markup Language, the standard markup language for creating web pages.',
            '/\bcss\b|\bwhat is css\b|\bdefine css\b/i' => 'CSS stands for Cascading Style Sheets, a style sheet language used for describing the presentation of a document written in HTML.',
            '/\boop\b|\bwhat is oop\b|\bdefine oop\b|\bobject oriented php\b/i' => 'OOP in PHP stands for Object-Oriented Programming, which includes Classes, Properties, Methods, Constructors, Inheritance, Polymorphism, and more.',
            '/\bfile handling\b|\bwhat is file handling\b|\bdefine file handling in php\b/i' => 'File handling in PHP includes reading from and writing to files, using functions like fopen(), fread(), fwrite(), and fclose().',
            '/\bcookies\b|\bwhat are cookies\b|\bdefine cookies in php\b/i' => 'Cookies in PHP are small files that the server embeds on the user’s computer, often used to remember user data across pages.',
            '/\bsessions\b|\bwhat are sessions\b|\bdefine sessions in php\b/i' => 'Sessions in PHP are used to store information (in variables) to be used across multiple pages, and they remain active until the user closes the browser.',
            '/\bweb scraping\b|\bwhat is web scraping\b|\bdefine web scraping in php\b/i' => 'Web scraping in PHP can be done using cURL or file_get_contents to extract data from websites.',
            '/\bcurl\b|\bwhat is curl\b|\bdefine curl in php\b/i' => 'cURL in PHP is a library used to make HTTP requests to fetch data from external websites or APIs.',
            '/\bregular expressions\b|\bwhat are regular expressions\b|\bdefine regex in php\b/i' => 'Regular expressions (regex) in PHP are patterns used for searching and replacing within strings.',
            '/\bmail function\b|\bwhat is mail function\b|\bdefine mail function in php\b/i' => 'The mail() function in PHP is used to send emails directly from a script.',
            '/\bapi\b|\bwhat is api\b|\bdefine api in php\b/i' => 'APIs (Application Programming Interfaces) in PHP are used to interact with external services by sending and receiving data.',
            '/\blaravel\b|\bwhat is laravel\b|\bdefine laravel\b|\bphp mvc framework\b/i' => 'Laravel is a PHP MVC framework designed for building web applications, featuring routing, sessions, and database handling.',
            '/\bmysql\b|\bwhat is mysql\b|\bdefine mysql in php\b/i' => 'MySQL is a relational database system, and in PHP, MySQL can be accessed using extensions like MySQLi or PDO.',
            '/\bweb sockets\b|\bwhat are web sockets\b|\bdefine web sockets in php\b/i' => 'WebSockets allow two-way communication between a client and server, which is useful for real-time applications like chats or live data feeds.',

            // Course Information
            '/\bcourse code\b|\bsubject code\b|\bwhat is course code\b|\bdefine course code\b/i' => 'Course Code : SEIT4031.',
            '/\bcourse name\b|\bsubject name\b|\bwhat is course name\b|\bdefine course name\b/i' => 'Course Name : Advanced Web Technologies.',

            // Syllabus Queries
            '/\bsyllabus of section (\d+)\b/i' => function($matches) {
                $section = 'section' . $matches[1];
                return $this->getSyllabus('section', $section);
            },
            '/\bmodule (\d+) of section (\d+)\b/i' => function($matches) {
                $section = 'section' . $matches[2];
                $module = 'module' . $matches[1];
                return $this->getSyllabus('module', $module, $section);
            },
            '/\bsyllabus of this subject\b/i' => function() {
                return $this->getFullSyllabus();
            },
            '/\bname of module (\d+)\b/i' => function($matches) {
                return $this->getModuleName($matches[1]);
            },

            // Default/Fallback
            '/.*/' => 'I\'m sorry, I didn\'t understand that. Could you please rephrase?',
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleRequest();
        }
    }

    private function handleRequest() {
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'sendMessage':
                $message = isset($_POST['message']) ? $_POST['message'] : '';
                $this->sendMessage($message);
                break;
            case 'getMessages':
                $this->getMessages();
                break;
            default:
                $this->sendResponse(['success' => false, 'message' => 'Invalid Action']);
                break;
        }
    }

    private function sendMessage($message) {
        $userId = $this->msgSession->getSession('user_id'); // The actual user
        $dateTime = date("Y-m-d H:i:s");

        if (!empty($userId) && !empty($message)) {
            // Sanitize the message to prevent XSS
            $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

            // Insert user message into bot_messages table
            $sql = "INSERT INTO bot_messages (user_id, message, created_at) VALUES (?, ?, ?)";
            $arr = array($userId, $message, $dateTime);
            $result = $this->db->simplequery($sql, $arr);

            if ($result) {
                // Generate bot reply
                $botReply = $this->getBotReply($message);

                // Insert bot reply into bot_messages table
                $botUserId = 0; // Bot's user_id
                $sqlBot = "INSERT INTO bot_messages (user_id, message, created_at) VALUES (?, ?, ?)";
                $arrBot = array($botUserId, $botReply, $dateTime);
                $resultBot = $this->db->simplequery($sqlBot, $arrBot);

                if ($resultBot) {
                    $this->sendResponse(['success' => true, 'bot_reply' => $botReply]);
                } else {
                    $this->sendResponse(['success' => false, 'message' => 'Failed to send bot reply.']);
                }
            } else {
                $this->sendResponse(['success' => false, 'message' => 'Failed to send message.']);
            }
        } else {
            $this->sendResponse(['success' => false, 'message' => 'Invalid Data']);
        }
        exit();
    }

    private function sendResponse($response) {
        echo json_encode($response);
        exit();
    }

    private function getBotReply($message) {
        foreach ($this->patterns as $pattern => $response) {
            if (preg_match($pattern, $message, $matches)) {
                if (is_callable($response)) {
                    return $response($matches);
                }
                return $response;
            }
        }

        // If no pattern matches, return default response
        return 'I\'m sorry, I didn\'t understand that. Could you please rephrase?';
    }

    private function getSyllabus($type, $identifier, $section = null) {
        if ($type === 'section') {
            if (isset($this->syllabus[$identifier])) {
                $response = "Syllabus for " . ucfirst($identifier) . ":\n";
                foreach ($this->syllabus[$identifier] as $module => $details) {
                    $response .= ucfirst($module) . ": " . $details . "\n";
                }
                return nl2br($response);
            }
        } elseif ($type === 'module' && $section) {
            if (isset($this->syllabus[$section][$identifier])) {
                return "Syllabus for <b> " . ucfirst($identifier) . " </b>of " . ucfirst($section) . ":\n" . $this->syllabus[$section][$identifier];
            }
        }
        return "I'm sorry, I couldn't find the syllabus information you requested.";
    }

    private function getFullSyllabus() {
        $response = "Full Syllabus:\n\n";
        foreach ($this->syllabus as $section => $modules) {
            $response .= ucfirst($section) . ":\n";
            foreach ($modules as $module => $details) {
                $response .= "  \n" . ucfirst($module) . ":\n" . $details . "\n";
            }
        }
        return nl2br($response);
    }

    private function getModuleName($moduleNumber) {
        foreach ($this->syllabus as $section => $modules) {
            $moduleKey = 'module' . $moduleNumber;
            if (isset($modules[$moduleKey])) {
                return $modules[$moduleKey]; // Return only the module name
            }
        }
        return "I'm sorry, I couldn't find the module name you requested.";
    }

    private function getMessages() {
        $userId = $this->msgSession->getSession('user_id');

        if (!$userId) {
            echo json_encode([]);
            exit();
        }

        // Fetch messages between the user and the bot
        $sql = "SELECT bm.*, u.user_name FROM bot_messages bm 
                LEFT JOIN user u ON bm.user_id = u.user_id 
                WHERE bm.user_id = ? OR bm.user_id = 0 
                ORDER BY bm.created_at ASC";
        $arr = array($userId);
        $query = $this->db->simplequery($sql, $arr);
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        $messages = [];
        foreach ($results as $result) {
            $formattedDate = date('d/m/y', strtotime($result->created_at));
            $formattedTime = date('h:i A', strtotime($result->created_at));

            $messages[] = [
                'user_id' => $result->user_id,
                'user_name' => $result->user_name ? $result->user_name : 'Bot',
                'message' => $result->message,
                'created_at' => $result->created_at,
                'formatted_date' => $formattedDate,
                'formatted_time' => $formattedTime,
                'self' => $userId == $result->user_id
            ];
        }

        echo json_encode($messages);
        exit();
    }
}

new BotMessages();
?>
