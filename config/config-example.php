<?php
	/* Don't forget to turn on caching if you're deploying to production! */
    $enableHTMLCacheServe = false;
	$WebsiteURL = "http://www.skeleton.localhost"; /* If you don't change this to match your domain, your site won't appear to work at all */
	$WebsiteTitle = "Skeleton Website Framework";
	$WebsiteLanguage = "en"; /* Use Language Codes */
	$WebsiteLanguageCountry = "US"; /* Use country codes */
	$WebsiteLanguageLocale = "en_US"; /* Use Country Code plus locale */
	$WebsiteImage = "images/laptop-computer-writing-technology-web-internet.webp"; /* This image will be used as a default thumbnail any time the page image is not defined */
	$WebsiteDescription = "Creating websites shouldn't be a daunting task. With Skeleton Website Framework, simplicity and functionality merge seamlessly, offering you a hassle-free experience in website development."; /* Set a default description/excerpt for all pages */
	$WebsiteAuthor = "Scary le Poo"; /* Set a default page author */
	$WebsiteKeywords = "skeleton,framework,development,website,simplicity,security,ease,customize,flexibility"; /* Set default Keywords for site pages */

    $currentURL = $WebsiteURL . $_SERVER['REQUEST_URI'];
	
    /* Select a Theme */
	$theme = "skeleton";
	
	/* Display page name on home page? */
	$showhomepagetitle = true;

    /* Do we want any plugins? */
	$loadplugins = true;

    if ($loadplugins == true) {
        /* Choose what plugins you want to load here */
		
		/* SETTING THIS TO FALSE WILL BREAK ANYTHING THAT RELIES ON JQUERY */
		/* Do we want to load jQuery? The anser to this is almost always going to be yes. */
		$jQuery = true;
		
		/* SETTING THIS TO FALSE WILL BREAK SMOOTHSCROLL COMPLETELY */
		/* Add a class automatically to anchor links (Typically used for setting scroll-margin-top properties so that navigation bars don't cover the content */
		$anchorLinkAutoClass = true;
		
		/* SETTING THIS TO FALSE WILL BREAK ANCHOR LINKS COMPLETELY */
		/* Rewrite anchor link target urls so that they target the current url */
		/* This script will dynamically update all anchor links that start with "#" to include the base URL of the current page. This way, relative URLs will remain intact, and only the anchor links will be modified to include the current page's path. */
		$anchorLinkCurrentURLRewrite = true;
		
		/* If meta box is active, do we want to rewrite all urls so that we can stay in meta box mode? */
		$metaInfoBoxRewriteURL = true;
            
        /* FontAwesome */
        $fontAwesome = false;
		
		/* yBox (Lightbox) */
        $yBox = true;
    }	
	/* How many columns in the footer? */
	/* The Footer files are md files in pages/footer. The names must be footer1.md, footer2.md, footer3.md, etc. They will be displayed in order from left to right. The footer will try to read as many files as you have number of footer columns set. */
	
	$numberFooterColumns = 3;	
?>