document.addEventListener("DOMContentLoaded", () => {
    const betForm = document.getElementById("bet-form");

    betForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const userId = document.getElementById("user_id").value;
        const roundId = document.getElementById("round_id").value;
        const choice = document.getElementById("choice").value;
        const betAmount = document.getElementById("bet_amount").value;

        fetch("place_bet.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `user_id=${userId}&round_id=${roundId}&choice=${choice}&bet_amount=${betAmount}`
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message || data.error);
        });
    });
});

function fetchResults() {
    fetch("history.php")
        .then(response => response.json())
        .then(data => {
            let html = "<ul>";
            data.forEach(round => {
                html += `<li>Kỳ #${round.id} - Kết quả: ${round.result}</li>`;
            });
            html += "</ul>";
            document.getElementById("results").innerHTML = html;
        });
}
