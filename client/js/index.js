let spentTimeBoolean = false;
const startTime = new Date().getTime();
const needleTimeSpent = 30000;

function trackTime() {
    setTimeout(() => {
        spentTimeBoolean = true;
    }, needleTimeSpent);
}
trackTime();

document.querySelector('form').addEventListener('submit', function(event) {
    let currentTime = new Date().getTime();
    if (currentTime - startTime >= needleTimeSpent) {
        spentTimeBoolean = true;
    }
    document.getElementById('spent_time').value = spentTimeBoolean ? 1 : 0;
});