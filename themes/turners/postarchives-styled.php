</head>
<body>

	<!-- Primary Page Layout
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<div class="contentcontainer">
		<div class="pagetitle">
		<?php if ($pagename != "home") { ?>
			<?php if (isset($pagetitle)) { ?>
				<h1><?php echo $pagetitle; ?></h1>
			<?php } else { ?>	
				<h1><?php echo ucwords($pagename); ?></h1>
			<?php } ?>
		<?php } ?>
		</div>
		<div class="content">

			<?php

			// Folder containing the Article files
			$postsFolder = 'posts';

			// Array to store file details
			$fileDetails = array();

			// Loop through each file in the Article folder
			foreach (glob("pages/$postsFolder/*.html") as $file) {
				// Read the file contents
				$contents = file_get_contents($file);

				// Extract pagetitle, date, thumbnail, and excerpt from HTML comments
				preg_match('/<!--\s+pagetitle:(.*?)\s+-->/s', $contents, $titleMatch); //This will be the linktext
				preg_match('/<!--\s+pagedate:(.*?)\s+-->/s', $contents, $dateMatch); //This needs to be mm/dd/yyyy format
				preg_match('/<!--\s+pageimage:(.*?)\s+-->/s', $contents, $imageMatch); //Image filename with extension
				preg_match('/<!--\s+pageexcerpt:(.*?)\s+-->/s', $contents, $excerptMatch); //No real formatting here, just a blurb
                preg_match('/<!--\s+pageauthor:(.*?)\s+-->/s', $contents, $authorMatch); //No real formatting here, just a blurb

				// If all details are found, add them to the array
				if ($titleMatch && $dateMatch && $imageMatch && $excerptMatch) {
					$title = trim($titleMatch[1]);
					$date = trim($dateMatch[1]);
					$image = trim($imageMatch[1]);
					$excerpt = trim($excerptMatch[1]);
					$author = trim($authorMatch[1]);
					$fileDetails[] = array('title' => $title, 'date' => $date, 'image' => $image, 'excerpt' => $excerpt, 'author' => $author, 'filename' => $file);
				}
			}

			// Sort the array by date in descending order
			usort($fileDetails, function ($a, $b) {
				return strtotime($b['date']) - strtotime($a['date']);
			});

			// Pagination
			$itemsPerPage = 5;
			$page = isset($_GET['page']) ? $_GET['page'] : 1;
			$startIndex = ($page - 1) * $itemsPerPage;
			$fileDetailsPage = array_slice($fileDetails, $startIndex, $itemsPerPage);

			// Output the sorted list of links, images, and excerpts for the current page
			/* This is where you would set up the classes for styling the post archives page */
			echo '<div class="row">';
			foreach ($fileDetailsPage as $fileDetail) {
				echo '<div class="column flex-basis-300">';
				$dateFormatted = date('m/d/Y', strtotime($fileDetail['date']));
				echo '<b><a href="' . $postsFolder . '/' . basename($fileDetail['filename'], '.html') . '">' . $fileDetail['title'] . '</a></b> </br> ' . $dateFormatted . '</br>' . 'by <i>' . $fileDetail['author'] . '</i></br>';
				if (file_exists($fileDetail['image'])) {
					echo '<img src="' . $fileDetail['image'] . '" alt="' . $fileDetail['title'] . '"><br>';
				} else {
					echo 'Image not found for ' . $fileDetail['title'] . '<br>';
					echo 'Imagepath: ' . $fileDetail['image'];
				}
				echo '<p>' . $fileDetail['excerpt'] . '</p><br>';
				echo '</div>';
			}
			echo '</div>';

			// Pagination links
			$totalPages = ceil(count($fileDetails) / $itemsPerPage);
			echo '<div class="pagination">Page: ';
			for ($i = 1; $i <= $totalPages; $i++) {
				if ($i == $page) {
					echo "<span>$i</span> ";
				} else {
					echo "<a href='$pagename?page=$i'>$i</a> ";
				}
			}
			echo '</div>';

			?>

		</div>
	</div>

<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
