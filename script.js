document.getElementById('ticketForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const issue = document.getElementById('issue').value;

    const ticketList = document.getElementById('ticketList');
    const ticketDiv = document.createElement('div');
    ticketDiv.className = 'ticket';

    ticketDiv.innerHTML = `
        <p><strong>Name:</strong> ${name}</p>
        <p><strong>Email:</strong> ${email}</p>
        <p><strong>Issue:</strong> ${issue}</p>
    `;

    ticketList.appendChild(ticketDiv);

    document.getElementById('ticketForm').reset();
});
