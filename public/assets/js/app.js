const unit = document.getElementById('unit');

const ws = new WebSocket('ws://localhost:20205');
ws.send('Hello');