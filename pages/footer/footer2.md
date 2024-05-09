<!-- sectiontitle:Send Us a Message -->

<div class="textalign-left">
<form onsubmit="sendEmail(); return false;">
<label for="subject">Subject:</label><br>
<input type="text" id="subject" name="subject" required><br>

<label for="message">Message:</label><br>
<textarea id="message" name="body" rows="4" cols="50" required></textarea><br><br>

<input type="submit" value="Send Email">
</form>

<script>
function sendEmail() {
var subject = document.getElementById("subject").value;
var message = document.getElementById("message").value;
var mailtoLink = "recipient@example.com" +
 "?subject=" + encodeURIComponent(subject) +
 "&body=" + encodeURIComponent(message);
window.location.href = mailtoLink;
}
</script>
</div>