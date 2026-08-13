const receiverInput = document.getElementById("receiver");
const userSuggestions = document.getElementById("userSuggestions");

if (receiverInput && userSuggestions) {

    receiverInput.addEventListener("input", async function () {

        const search = receiverInput.value.trim();

        if (search.length < 2) {
            userSuggestions.innerHTML = "";
            userSuggestions.style.display = "none";
            return;
        }

        try {

            const response = await fetch(
                "ajax/search-users.php?search=" +
                encodeURIComponent(search)
            );

            const users = await response.json();

            userSuggestions.innerHTML = "";

            if (users.length === 0) {
                userSuggestions.style.display = "none";
                return;
            }

            users.forEach(function (user) {

                const suggestion = document.createElement("div");

                suggestion.classList.add("user-suggestion");
                suggestion.textContent = user.username;

                suggestion.addEventListener("click", function () {

                    receiverInput.value = user.username;

                    userSuggestions.innerHTML = "";
                    userSuggestions.style.display = "none";

                });

                userSuggestions.appendChild(suggestion);

            });

            userSuggestions.style.display = "block";

        } catch (error) {

            console.error("Error loading users:", error);

        }

    });

}


/* =========================
   AUTOMATIC BALANCE UPDATE
========================= */

const balanceAmount = document.getElementById("balanceAmount");

async function updateBalance() {

    if (!balanceAmount) {
        return;
    }

    try {

        const response = await fetch("ajax/get-balance.php");

        if (!response.ok) {
            return;
        }

        const data = await response.json();

        balanceAmount.textContent = data.balance + " XD";

    } catch (error) {

        console.error("Error loading balance:", error);

    }

}

if (balanceAmount) {

    setInterval(updateBalance, 10000);

}