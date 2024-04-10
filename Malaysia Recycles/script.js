<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('searchForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const material = document.getElementById('materialSelect').value;
        
        const addresses = {
            'plastic': 'Jalan Teknologi 5, Taman Teknologi Malaysia, Kuala Lumpur',
            'metal': 'Kota Damansara, Petaling Jaya, Selangor',
            'paper': 'Jln Cheras, Taman Pertama Cheras, Kuala Lumpur',
            'glass': 'Glass recycling location address',
            'general': 'General waste location address'
        };

        const address = addresses[material] || 'Please select a material to find a recycling center.';
        
        document.getElementById('mapContent').textContent = `Location: ${address}`;
    })
  });
</script>

function markGoing(eventId) {
  var eventElement = document.getElementById(eventId);
  // Here you would typically send an AJAX request to update the status
  // For demonstration purposes, we're just changing the background color
  eventElement.style.backgroundColor = "#dff0d8"; // Light green background
}

function removeEvent(eventId) {
  var eventElement = document.getElementById(eventId);
  eventElement.remove();
  // Here you might want to send an AJAX request to your server to remove the event from the user's list
}


// Simulated data fetch function
function fetchData() {
  // Simulate API call
  setTimeout(() => {
    updateStatistics('eventsCount', 12);
    updateStatistics('usersCount', 124);
    updateStatistics('registrationsCount', 50);
  }, 1000);
}




