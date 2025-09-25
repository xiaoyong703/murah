// Revision HQ Main JavaScript

// Theme Toggle
function toggleTheme() {
    const html = document.documentElement;
    const currentTheme = html.getAttribute('data-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    html.setAttribute('data-theme', newTheme);
    
    const themeIcon = document.querySelector('.theme-switcher i');
    if (themeIcon) {
        themeIcon.className = newTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
    }
    
    localStorage.setItem('theme', newTheme);
}

// Pomodoro Timer
let timerInterval = null;
let timeLeft = 25 * 60;
let isRunning = false;

function updateTimerDisplay() {
    const timerDisplay = document.getElementById('timerDisplay');
    if (timerDisplay) {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        timerDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }
}

function startTimer() {
    if (isRunning) return;
    isRunning = true;
    const startBtn = document.getElementById('startBtn');
    if (startBtn) startBtn.textContent = 'Running...';
    
    timerInterval = setInterval(() => {
        timeLeft--;
        updateTimerDisplay();
        
        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            isRunning = false;
            if (startBtn) startBtn.textContent = 'Start';
            alert('Pomodoro Complete! Time for a break!');
        }
    }, 1000);
}

function pauseTimer() {
    if (!isRunning) return;
    clearInterval(timerInterval);
    isRunning = false;
    const startBtn = document.getElementById('startBtn');
    if (startBtn) startBtn.textContent = 'Start';
}

function resetTimer() {
    clearInterval(timerInterval);
    isRunning = false;
    const activePreset = document.querySelector('.timer-preset.active');
    if (activePreset) {
        timeLeft = parseInt(activePreset.dataset.minutes) * 60;
    }
    updateTimerDisplay();
    const startBtn = document.getElementById('startBtn');
    if (startBtn) startBtn.textContent = 'Start';
}

// Todo Functions
function addTodo() {
    const input = document.getElementById('todoInput');
    const todoList = document.getElementById('todoList');
    
    if (!input || !todoList) return;
    
    const text = input.value.trim();
    if (!text) return;

    const todoItem = document.createElement('div');
    todoItem.className = 'todo-item';
    todoItem.innerHTML = `
        <input type="checkbox" class="todo-checkbox" onchange="toggleCompleted(this)">
        <span class="todo-text">${text}</span>
        <button class="todo-delete" onclick="deleteTask(this)">×</button>
    `;
    todoList.appendChild(todoItem);
    input.value = '';
}

function deleteTask(button) {
    button.parentElement.remove();
}

function toggleCompleted(checkbox) {
    const todoItem = checkbox.parentElement;
    todoItem.classList.toggle('completed', checkbox.checked);
}

// Calculator
let calcExpression = '';

function appendToCalc(value) {
    const calcDisplay = document.getElementById('calcDisplay');
    if (!calcDisplay) return;
    calcExpression += value;
    calcDisplay.textContent = calcExpression || '0';
}

function clearCalc() {
    const calcDisplay = document.getElementById('calcDisplay');
    if (!calcDisplay) return;
    calcExpression = '';
    calcDisplay.textContent = '0';
}

function deleteLast() {
    const calcDisplay = document.getElementById('calcDisplay');
    if (!calcDisplay) return;
    calcExpression = calcExpression.slice(0, -1);
    calcDisplay.textContent = calcExpression || '0';
}

function calculate() {
    const calcDisplay = document.getElementById('calcDisplay');
    if (!calcDisplay) return;
    
    try {
        const result = eval(calcExpression.replace(/×/g, '*').replace(/÷/g, '/'));
        calcDisplay.textContent = result;
        calcExpression = result.toString();
    } catch (error) {
        calcDisplay.textContent = 'Error';
        calcExpression = '';
    }
}

// Unit Converter
const conversions = {
    length: { m: 1, cm: 100, ft: 3.28084, in: 39.3701 },
    weight: { kg: 1, g: 1000, lb: 2.20462, oz: 35.274 }
};

function updateUnitOptions() {
    const type = document.getElementById('unitType');
    const fromUnit = document.getElementById('fromUnit');
    const toUnit = document.getElementById('toUnit');
    
    if (!type || !fromUnit || !toUnit) return;
    
    let options = '';
    if (type.value === 'length') {
        options = '<option value="m">Meters</option><option value="cm">Centimeters</option><option value="ft">Feet</option><option value="in">Inches</option>';
    } else if (type.value === 'weight') {
        options = '<option value="kg">Kilograms</option><option value="g">Grams</option><option value="lb">Pounds</option><option value="oz">Ounces</option>';
    }
    
    fromUnit.innerHTML = options;
    toUnit.innerHTML = options;
}

function convertUnits() {
    const fromValue = document.getElementById('fromValue');
    const fromUnit = document.getElementById('fromUnit');
    const toUnit = document.getElementById('toUnit');
    const toValue = document.getElementById('toValue');
    const unitType = document.getElementById('unitType');
    
    if (!fromValue || !fromUnit || !toUnit || !toValue || !unitType) return;
    
    const value = parseFloat(fromValue.value);
    if (isNaN(value)) return;
    
    const type = unitType.value;
    const fromFactor = conversions[type][fromUnit.value];
    const toFactor = conversions[type][toUnit.value];
    const result = value / fromFactor * toFactor;
    
    toValue.value = result.toFixed(6);
}

// Word Counter
function updateWordCount() {
    const textElement = document.getElementById('wordCountText');
    const wordCountElement = document.getElementById('wordCount');
    const charCountElement = document.getElementById('charCount');
    
    if (!textElement || !wordCountElement || !charCountElement) return;
    
    const text = textElement.value;
    const words = text.trim() ? text.trim().split(/\s+/).length : 0;
    const chars = text.length;
    
    wordCountElement.textContent = words;
    charCountElement.textContent = chars;
}

// QR Generator
function generateQR() {
    const text = document.getElementById('qrText').value.trim();
    const qrResult = document.getElementById('qrResult');
    
    if (!text || !qrResult) return;
    
    const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent(text)}`;
    qrResult.innerHTML = `<img src="${qrUrl}" alt="QR Code" style="max-width: 100%;">`;
}

// User Menu
function toggleUserMenu() {
    const dropdown = document.getElementById('userDropdown');
    if (dropdown) {
        dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    }
}

// Wallpaper Modal
function openWallpaperModal() {
    alert('Wallpaper feature - Coming soon!');
}

// Google Sign-In
function handleCredentialResponse(response) {
    console.log('Login successful');
    window.location.href = 'dashboard.html';
}

// Clipboard
function copyToClipboard(element) {
    const text = element.textContent;
    navigator.clipboard.writeText(text);
    element.style.background = 'var(--success)';
    setTimeout(() => element.style.background = '', 500);
}

function clearClipboard() {
    const clipboardList = document.getElementById('clipboardList');
    if (clipboardList) {
        clipboardList.innerHTML = '<div class="clipboard-item">No items</div>';
    }
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', savedTheme);
    
    updateTimerDisplay();
    updateUnitOptions();
    
    // Timer presets
    document.querySelectorAll('.timer-preset').forEach(preset => {
        preset.addEventListener('click', () => {
            document.querySelectorAll('.timer-preset').forEach(p => p.classList.remove('active'));
            preset.classList.add('active');
            if (!isRunning) {
                timeLeft = parseInt(preset.dataset.minutes) * 60;
                updateTimerDisplay();
            }
        });
    });
    
    // Todo input enter key
    const todoInput = document.getElementById('todoInput');
    if (todoInput) {
        todoInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') addTodo();
        });
    }
});
