// Get the submit button element
var submitButton = document.getElementById('submit-btn');

// Add event listener to the submit button
submitButton.addEventListener('click', function(event) {
  // Prevent the default form submission behavior
  event.preventDefault();

  // Perform an AJAX request to update the queue_data.php file
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'queue_data.php', true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Request completed successfully
      console.log('Queue data updated!');
    }
  };
  xhr.send();
});