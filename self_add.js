
// Reload the index file every 60 seconds
setInterval(function () {
    location.reload();
}, 60000);


//para sa partysize INPUT
var partySizeInput = document.getElementById('party_size');
var submitBtn = document.getElementById('submit-btn');
var currentPartySize = 0;

function updatePartySize() {
    partySizeInput.value = currentPartySize.toString();
    submitBtn.disabled = currentPartySize === 0;
}

function incrementPartySize() {
    if (currentPartySize < 50) {
        currentPartySize += 2;
        updatePartySize();
    }
}

function decrementPartySize() {
    if (currentPartySize > 0) {
        currentPartySize -= 2;
        updatePartySize();
    }
}

updatePartySize();