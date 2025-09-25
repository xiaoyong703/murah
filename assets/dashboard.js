// Theme management
function toggleTheme() {
    const html = document.documentElement;
    const currentTheme = html.getAttribute('data-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    html.setAttribute('data-theme', newTheme);
    
    // Update theme icon
    const themeIcon = document.querySelector('.theme-switcher i');
    if (themeIcon) {
        themeIcon.className = newTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
    }
    
    // Save preference
    localStorage.setItem('theme', newTheme);
}

// User menu toggle
function toggleUserMenu() {
    const dropdown = document.getElementById('userDropdown');
    if (dropdown) {
        dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    }
}

// Pomodoro Timer functionality
let timerInterval = null;
let timeLeft = 25 * 60;
let isRunning = false;

function updateTimerDisplay() {
    const timerDisplay = document.getElementById('timerDisplay');
    if (timerDisplay) {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        timerDisplay.textContent = 
            `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }
}

function startTimer() {
    if (isRunning) return;
    
    isRunning = true;
    const startBtn = document.getElementById('startBtn');
    if (startBtn) {
        startBtn.textContent = 'Running...';
    }
    
    timerInterval = setInterval(() => {
        timeLeft--;
        updateTimerDisplay();
        
        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            isRunning = false;
            if (startBtn) {
                startBtn.textContent = 'Start';
            }
            
            if (Notification.permission === 'granted') {
                new Notification('Pomodoro Complete!', {
                    body: 'Time for a break!',
                    icon: '/favicon.ico'
                });
            } else {
                alert('Pomodoro Complete! Time for a break!');
            }
        }
    }, 1000);
}

function pauseTimer() {
    if (!isRunning) return;
    clearInterval(timerInterval);
    isRunning = false;
    const startBtn = document.getElementById('startBtn');
    if (startBtn) {
        startBtn.textContent = 'Start';
    }
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
    if (startBtn) {
        startBtn.textContent = 'Start';
    }
}

// Timer presets
function initTimerPresets() {
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
}

// Notes auto-save
let notesTimeout = null;
function initNotesAutoSave() {
    const notesTextarea = document.getElementById('quickNotes');
    const notesStatus = document.getElementById('notesStatus');
    
    if (notesTextarea && notesStatus) {
        notesTextarea.addEventListener('input', () => {
            notesStatus.textContent = 'Saving...';
            
            clearTimeout(notesTimeout);
            notesTimeout = setTimeout(() => {
                // Simulate saving to server
                notesStatus.textContent = 'Auto-saved';
                localStorage.setItem('quickNotes', notesTextarea.value);
            }, 1000);
        });
        
        // Load saved notes
        const savedNotes = localStorage.getItem('quickNotes');
        if (savedNotes) {
            notesTextarea.value = savedNotes;
        }
    }
}

// Todo functionality
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
    
    saveTodos();
}

function deleteTask(button) {
    button.parentElement.remove();
    saveTodos();
}

function toggleCompleted(checkbox) {
    const todoItem = checkbox.parentElement;
    todoItem.classList.toggle('completed', checkbox.checked);
    saveTodos();
}

function saveTodos() {
    const todos = [];
    document.querySelectorAll('.todo-item').forEach(item => {
        const textElement = item.querySelector('.todo-text');
        const checkbox = item.querySelector('.todo-checkbox');
        if (textElement && checkbox) {
            todos.push({
                text: textElement.textContent,
                completed: checkbox.checked
            });
        }
    });
    localStorage.setItem('todos', JSON.stringify(todos));
}

function loadTodos() {
    const savedTodos = localStorage.getItem('todos');
    const todoList = document.getElementById('todoList');
    
    if (savedTodos && todoList) {
        const todos = JSON.parse(savedTodos);
        todoList.innerHTML = '';
        
        todos.forEach(todo => {
            const todoItem = document.createElement('div');
            todoItem.className = `todo-item ${todo.completed ? 'completed' : ''}`;
            todoItem.innerHTML = `
                <input type="checkbox" class="todo-checkbox" ${todo.completed ? 'checked' : ''} onchange="toggleCompleted(this)">
                <span class="todo-text">${todo.text}</span>
                <button class="todo-delete" onclick="deleteTask(this)">×</button>
            `;
            todoList.appendChild(todoItem);
        });
    }
}

// Calculator functionality
let calcExpression = '';
let lastResult = false;

function appendToCalc(value) {
    const calcDisplay = document.getElementById('calcDisplay');
    if (!calcDisplay) return;
    
    if (lastResult && !isNaN(value)) {
        calcExpression = '';
        lastResult = false;
    }
    calcExpression += value;
    calcDisplay.textContent = calcExpression || '0';
}

function clearCalc() {
    const calcDisplay = document.getElementById('calcDisplay');
    if (!calcDisplay) return;
    
    calcExpression = '';
    calcDisplay.textContent = '0';
    lastResult = false;
}

function deleteLast() {
    const calcDisplay = document.getElementById('calcDisplay');
    if (!calcDisplay) return;
    
    calcExpression = calcExpression.slice(0, -1);
    calcDisplay.textContent = calcExpression || '0';
    lastResult = false;
}

function calculate() {
    const calcDisplay = document.getElementById('calcDisplay');
    if (!calcDisplay) return;
    
    try {
        const result = eval(calcExpression.replace(/×/g, '*').replace(/÷/g, '/'));
        calcDisplay.textContent = result;
        calcExpression = result.toString();
        lastResult = true;
    } catch (error) {
        calcDisplay.textContent = 'Error';
        calcExpression = '';
    }
}

// Unit converter
const conversions = {
    length: { m: 1, cm: 100, ft: 3.28084, in: 39.3701 },
    weight: { kg: 1, g: 1000, lb: 2.20462, oz: 35.274 },
    temperature: { c: (val) => val, f: (val) => (val * 9/5) + 32, k: (val) => val + 273.15 }
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
    } else if (type.value === 'temperature') {
        options = '<option value="c">Celsius</option><option value="f">Fahrenheit</option><option value="k">Kelvin</option>';
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
    let result;
    
    if (type === 'temperature') {
        let celsius = value;
        if (fromUnit.value === 'f') celsius = (value - 32) * 5/9;
        if (fromUnit.value === 'k') celsius = value - 273.15;
        
        if (toUnit.value === 'c') result = celsius;
        if (toUnit.value === 'f') result = (celsius * 9/5) + 32;
        if (toUnit.value === 'k') result = celsius + 273.15;
    } else {
        const fromFactor = conversions[type][fromUnit.value];
        const toFactor = conversions[type][toUnit.value];
        result = value / fromFactor * toFactor;
    }
    
    toValue.value = result.toFixed(6);
}

// Word counter
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

// Wallpaper functionality
function openWallpaperModal() {
    alert('Wallpaper modal - to be implemented with server backend');
}

// Close dropdowns when clicking outside
document.addEventListener('click', (e) => {
    if (!e.target.closest('.user-menu')) {
        const dropdown = document.getElementById('userDropdown');
        if (dropdown) dropdown.style.display = 'none';
    }
});

// Initialize everything when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize timer
    updateTimerDisplay();
    initTimerPresets();
    
    // Initialize notes
    initNotesAutoSave();
    
    // Initialize todos
    loadTodos();
    
    // Initialize unit converter
    updateUnitOptions();
    
    // Initialize word counter
    updateWordCount();
    
    // Todo input enter key
    const todoInput = document.getElementById('todoInput');
    if (todoInput) {
        todoInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') addTodo();
        });
    }
    
    // Request notification permission
    if ('Notification' in window && Notification.permission === 'default') {
        Notification.requestPermission();
    }
    
    // Load saved theme
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        document.documentElement.setAttribute('data-theme', savedTheme);
        const themeIcon = document.querySelector('.theme-switcher i');
        if
    closeWallpaperModal();
}

// Subject drag and drop
let draggedElement = null;

function initDragAndDrop() {
    document.querySelectorAll('.subject-tile').forEach(tile => {
        tile.addEventListener('dragstart', (e) => {
            draggedElement = e.target;
            e.target.classList.add('dragging');
        });
        
        tile.addEventListener('dragend', (e) => {
            e.target.classList.remove('dragging');
        });
        
        tile.addEventListener('dragover', (e) => {
            e.preventDefault();
        });
        
        tile.addEventListener('drop', (e) => {
            e.preventDefault();
            
            if (draggedElement && draggedElement !== e.target) {
                const container = e.target.closest('.subjects-grid');
                const afterElement = getDragAfterElement(container, e.clientY);
                
                if (afterElement == null) {
                    container.appendChild(draggedElement);
                } else {
                    container.insertBefore(draggedElement, afterElement);
                }
            }
        });
    });
}

function getDragAfterElement(container, y) {
    const draggableElements = [...container.querySelectorAll('.subject-tile:not(.dragging)')];
    
    return draggableElements.reduce((closest, child) => {
        const box = child.getBoundingClientRect();
        const offset = y - box.top - box.height / 2;
        
        if (offset < 0 && offset > closest.offset) {
            return { offset: offset, element: child };
        } else {
            return closest;
        }
    }, { offset: Number.NEGATIVE_INFINITY }).element;
}

// Close dropdowns when clicking outside
document.addEventListener('click', (e) => {
    if (!e.target.closest('.user-menu')) {
        const dropdown = document.getElementById('userDropdown');
        if (dropdown) dropdown.style.display = 'none';
    }
    
    if (!e.target.closest('.modal-content') && e.target.closest('.modal')) {
        document.querySelectorAll('.modal').forEach(modal => {
            modal.style.display = 'none';
        });
    }
});

// Enter key for todo input
document.addEventListener('DOMContentLoaded', function() {
    const todoInput = document.getElementById('todoInput');
    if (todoInput) {
        todoInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                addTodo();
            }
        });
    }
    
    // Request notification permission
    if ('Notification' in window && Notification.permission === 'default') {
        Notification.requestPermission();
    }
    
    // Load saved data
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        document.documentElement.setAttribute('data-theme', savedTheme);
        const themeIcon = document.querySelector('.theme-switcher i');
        themeIcon.className = savedTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
    }
    
    const savedWallpaper = localStorage.getItem('wallpaper');
    if (savedWallpaper) {
        setWallpaper(savedWallpaper);
    }
    
    // Initialize components
    updateTimerDisplay();
    updateUnitOptions();
    updateWordCount();
    loadTodos();
    updateClipboardList();
    initDragAndDrop();
});
    updateUnitOptions();
    updateWordCount();
});
