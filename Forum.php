<?php // <--- do NOT put anything before this PHP tag
include 'Functions.php';
$cookieMessage = getCookieMessage();
$cookieUser = getCookieUser();

if (isset($_GET['Topic'])) {
    $thisTopic = $_GET['Topic'];
} else {
    redirect('Topics.php');
}

?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta charset="UTF-8"> <!-- For emojis -->
</head>

<body>
    <div class="container">
        <div class="row" , id="header">
            <?php @include 'Header.php'; ?>
        </div>
        <div class="row" , id="nav">

        </div>
        <div class="row" , id="content">
            <div>
                <?php
                
                // Get all of the topics from the database
                $dbh = connectToDatabase();
                $statement = $dbh->prepare('SELECT TopicId FROM Topic WHERE Topic = ?');
                $statement->bindValue(1, $thisTopic);
                $statement->execute();
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                $topicID = $row['TopicID'];
                // var_dump($topicID);
                // $topics = $statement->fetchAll(PDO::FETCH_ASSOC);
                
                $statement = $dbh->prepare('SELECT COUNT(Post.PostID) FROM Post WHERE Post.TopicID = ? ;');
                $statement->bindValue(1, $topicID);
                $statement->execute();
                $count = $statement->fetchColumn();
                
                // Set the default page number to 1
                $pageNumber = 1;
                
                // Get the page number from the URL
                if (isset($_GET['page'])) {
                    $pageNumber = $_GET['page'];
                }
                
                // Calculate the offset
                $offset = ($pageNumber - 1) * 10;
                
                // Get the topics for the current page
                // $sql = ;
                $statement2 = $dbh->prepare("SELECT * FROM Post INNER JOIN User ON Post.UserID = User.UserID WHERE Post.TopicID = ?  ORDER BY Post.PostID DESC LIMIT 10 OFFSET $offset;");
                $statement2->bindValue(1, $topicID);
                $statement2->execute();
                $currentPosts = $statement2->fetchAll(PDO::FETCH_ASSOC);
                // Create the table
                echo '<div class="table-container">';
                echo '<table class="my-table">';
                echo '<tr><th>Topic</th><th>Created by</th><th>Datetime</th><th>Likes</th></tr>';
                foreach ($currentPosts as $post) {
                    echo '
                        <tr>
                            <td>' .
                        $post['Post'] .
                        '</td>
                            <td>' .
                        $post['FirstName'] .
                        ' ' .
                        $post['SurName'] .
                        '</td>
                            <td>' .
                        $post['DateTime'] .
                        '</td>
                            <td>
                                <span>
                                    <a href="Forum.php?postID=' .
                        $post['PostID'] .
                        '">
                                        ' .
                        $post['Likes'] .
                        '
                                        <svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16 0.5C13.9 0.5 12.05 1.55 11 3.2C9.95 1.55 8.1 0.5 6 0.5C2.7 0.5 0 3.2 0 6.5C0 12.45 11 18.5 11 18.5C11 18.5 22 12.5 22 6.5C22 3.2 19.3 0.5 16 0.5Z" fill="#F44336"/>
                                        </svg>
                                    </a>
                                </span>
                            </td>
                        </tr>
                    ';
                }
                
                echo '</table>';
                echo '</div>';
                
                // Create the pagination links
                echo '<div class="pagination-links">';
                for ($i = 1; $i <= ceil($count / 10); $i++) {
                    echo '<a href="?Topic=' . urlencode($thisTopic) . '&page=' . $i . '">' . $i . '</a> ';
                }
                echo '</div>';
                
                ?>
                <?php
                if (getCookieUser()) {
                    echo '<div class="sign_in_container">
                					<h1>Create new post</h1>
                					<form action="AddPost.php?Topic=' .
                        $thisTopic .
                        '" method="post">';
                
                    // Display message if set
                    $message = getCookieMessage();
                    if ($message) {
                        $messageClass = strpos($message, 'successfully') !== false ? 'success-message' : 'error-message';
                        echo '<div class="' . $messageClass . '">' . getCookieMessage() . '</div>';
                    }
                
                    echo '
                						<label for="post">Post:</label>
                                		<input type="text" id="post" name="Post">
                                		<input type="submit" value="Submit">
                                		</form>
                                		</div>';
                } else {
                    echo '<p>Please sign in to create a new topic.</p>';
                }
                ?>

            </div>
        </div>
        <div class="row" , id="footer">
            <?php @include 'Footer.php'; ?>
        </div>
    </div>
</body>

</html>
