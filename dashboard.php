<?php
session_start();

// Mock user data for demo (replace with actual database logic)
$user = [
    'name' => 'Demo User',
    'picture' => 'https://via.placeholder.com/40',
    'theme' => 'light',
    'wallpaper' => ''
];

$subjects = [
    ['name' => 'Computing', 'icon' => 'fas fa-laptop-code', 'color' => '#3b82f6', 'description' => 'Programming and computer science'],
    ['name' => 'History & Social Studies', 'icon' => 'fas fa-landmark', 'color' => '#f59e0b', 'description' => 'Historical events and society'],
    ['name' => 'Chemistry & Physics', 'icon' => 'fas fa-atom', 'color' => '#10b981', 'description' => 'Sciences and experiments'],
    ['name' => 'English', 'icon' => 'fas fa-book-open', 'color' => '#ef4444', 'description' => 'Language and literature'],
    ['name' => 'Chinese', 'icon' => 'fas fa-language', 'color' => '#f97316', 'description' => 'Chinese language studies'],
    ['name' => 'Math', 'icon' => 'fas fa-calculator', 'color' => '#8b5cf6', 'description' => 'Mathematics and algebra'],
    ['name' => 'A-Math', 'icon' => 'fas fa-square-root-alt', 'color' => '#ec4899', 'description' => 'Advanced mathematics'],
    ['name' => 'Electronics', 'icon' => 'fas fa-microchip', 'color' => '#06b6d4', 'description' => 'Electronic circuits and components']
];
?>
<!DOCTYPE html>
<html lang="en" data-theme="<?php echo $user['theme']; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revision HQ - Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="<?php echo !empty($user['wallpaper']) ? 'has-wallpaper' : ''; ?>">
    
    <!-- Header -->
    <header class="header">
        <a href="dashboard.php" class="logo">
            <div class="logo-icon">RHQ</div>
            Revision HQ
        </a>
        
        <div class="header-controls">
            <button class="theme-switcher" onclick="toggleTheme()">
                <i class="fas fa-moon"></i>
            </button>
            <button class="wallpaper-btn" onclick="openWallpaperModal()">
                <i class="fas fa-image"></i>
            </button>
            <div class="user-menu">
                <img src="<?php echo htmlspecialchars($user['picture']); ?>" 
                     alt="User Avatar" 
                     class="user-avatar" 
                     onclick="toggleUserMenu()">
                <div class="user-dropdown" id="userDropdown" style="display: none; position: absolute; top: 100%; right: 0; background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 8px; padding: 0.5rem; min-width: 120px; box-shadow: 0 4px 8px var(--shadow); z-index: 1000;">
                    <a href="index.php" style="display: block; padding: 0.5rem; color: var(--text-primary); text-decoration: none; border-radius: 4px;">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <div class="main-container">
        <!-- Left Column - Subjects -->
        <div class="subjects-column">
            <h2 style="margin-bottom: 1rem; color: var(--text-primary);">Subjects</h2>
            <div class="subjects-grid" id="subjectsGrid">
                <?php foreach ($subjects as $subject): ?>
                <a href="subjects/<?php echo strtolower(str_replace([' ', '&'], ['-', ''], $subject['name'])); ?>.php" class="subject-tile" draggable="true">
                    <div class="subject-icon" style="background: <?php echo $subject['color']; ?>">
                        <i class="<?php echo $subject['icon']; ?>"></i>
                    </div>
                    <div class="subject-name"><?php echo $subject['name']; ?></div>
                    <div class="subject-description"><?php echo $subject['description']; ?></div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Center Column - Widgets -->
        <div class="widgets-column">
            <!-- Today's Timetable -->
            <div class="widget">
                <div class="widget-header">
                    <h3 class="widget-title">Today's Timetable</h3>
                    <i class="fas fa-calendar-day widget-icon"></i>
                </div>
                <div class="timetable-entries">
                    <div class="timetable-entry">
                        <div class="timetable-time">09:00</div>
                        <div class="timetable-subject">Computing</div>
                        <div class="timetable-room">Room 3-01</div>
                    </div>
                    <div class="timetable-entry">
                        <div class="timetable-time">10:30</div>
                        <div class="timetable-subject">Mathematics</div>
                        <div class="timetable-room">Room 2-15</div>
                    </div>
                    <div class="timetable-entry">
                        <div class="timetable-time">13:00</div>
                        <div class="timetable-subject">Chemistry</div>
                        <div class="timetable-room">Lab A</div>
                    </div>
                </div>
            </div>

            <!-- Countdown to Next Test -->
            <div class="widget">
                <div class="widget-header">
                    <h3 class="widget-title">Next Test Countdown</h3>
                    <i class="fas fa-clock widget-icon"></i>
                </div>
                <div class="countdown-display">
                    <div class="countdown-time" id="countdownTime">5d 14h 32m</div>
                    <div class="countdown-label">Chemistry Test - Organic Compounds</div>
                </div>
            </div>

            <!-- Pomodoro Timer -->
            <div class="widget">
                <div class="widget-header">
                    <h3 class="widget-title">Pomodoro Timer</h3>
                    <i class="fas fa-stopwatch widget-icon"></i>
                </div>
                <div class="pomodoro-timer">
                    <div class="timer-display" id="timerDisplay">25:00</div>
                    <div class="timer-controls">
                        <button class="timer-btn" id="startBtn" onclick="startTimer()">Start</button>
                        <button class="timer-btn secondary" onclick="pauseTimer()">Pause</button>
                        <button class="timer-btn secondary" onclick="resetTimer()">Reset</button>
                    </div>
                    <div class="timer-settings">
                        <div class="timer-preset active" data-minutes="25">25m</div>
                        <div class="timer-preset" data-minutes="15">15m</div>
                        <div class="timer-preset" data-minutes="5">5m</div>
                    </div>
                </div>
            </div>

            <!-- Quick Notes -->
            <div class="widget">
                <div class="widget-header">
                    <h3 class="widget-title">Quick Notes</h3>
                    <i class="fas fa-sticky-note widget-icon"></i>
                </div>
                <textarea class="notes-textarea" id="quickNotes" placeholder="Jot down quick notes here..."></textarea>
                <div class="notes-status" id="notesStatus">Auto-saved</div>
            </div>

            <!-- To-Do List -->
            <div class="widget">
                <div class="widget-header">
                    <h3 class="widget-title">To-Do List</h3>
                    <i class="fas fa-list-check widget-icon"></i>
                </div>
                <div class="todo-input">
                    <input type="text" id="todoInput" placeholder="Add a new task...">
                    <button class="add-todo-btn" onclick="addTodo()">Add</button>
                </div>
                <div class="todo-list" id="todoList">
                    <div class="todo-item">
                        <input type="checkbox" class="todo-checkbox" onchange="toggleCompleted(this)">
                        <span class="todo-text">Review chemistry formulas</span>
                        <button class="todo-delete" onclick="deleteTask(this)">×</button>
                    </div>
                    <div class="todo-item">
                        <input type="checkbox" class="todo-checkbox" onchange="toggleCompleted(this)">
                        <span class="todo-text">Complete math worksheet</span>
                        <button class="todo-delete" onclick="deleteTask(this)">×</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Quick Tools -->
        <div class="tools-column">
            <h2 style="margin-bottom: 1rem; color: var(--text-primary);">Quick Tools</h2>
            
            <!-- Calculator -->
            <div class="tool-widget">
                <h4 class="tool-title">
                    <i class="fas fa-calculator"></i>
                    Calculator
                </h4>
                <div class="calc-display" id="calcDisplay">0</div>
                <div class="calculator-grid">
                    <button class="calc-btn" onclick="clearCalc()">C</button>
                    <button class="calc-btn" onclick="appendToCalc('/')" data-op="/">÷</button>
                    <button class="calc-btn" onclick="appendToCalc('*')" data-op="*">×</button>
                    <button class="calc-btn" onclick="deleteLast()">⌫</button>
                    <button class="calc-btn" onclick="appendToCalc('7')">7</button>
                    <button class="calc-btn" onclick="appendToCalc('8')">8</button>
                    <button class="calc-btn" onclick="appendToCalc('9')">9</button>
                    <button class="calc-btn operator" onclick="appendToCalc('-')">-</button>
                    <button class="calc-btn" onclick="appendToCalc('4')">4</button>
                    <button class="calc-btn" onclick="appendToCalc('5')">5</button>
                    <button class="calc-btn" onclick="appendToCalc('6')">6</button>
                    <button class="calc-btn operator" onclick="appendToCalc('+')">+</button>
                    <button class="calc-btn" onclick="appendToCalc('1')">1</button>
                    <button class="calc-btn" onclick="appendToCalc('2')">2</button>
                    <button class="calc-btn" onclick="appendToCalc('3')">3</button>
                    <button class="calc-btn operator" onclick="calculate()" style="grid-row: span 2;">=</button>
                    <button class="calc-btn" onclick="appendToCalc('0')" style="grid-column: span 2;">0</button>
                    <button class="calc-btn" onclick="appendToCalc('.')">.</button>
                </div>
            </div>

            <!-- Unit Converter -->
            <div class="tool-widget">
                <h4 class="tool-title">
                    <i class="fas fa-exchange-alt"></i>
                    Unit Converter
                </h4>
                <div class="form-group">
                    <select class="form-select" id="unitType" onchange="updateUnitOptions()">
                        <option value="length">Length</option>
                        <option value="weight">Weight</option>
                        <option value="temperature">Temperature</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="number" class="form-input" id="fromValue" placeholder="From" oninput="convertUnits()">
                    <select class="form-select" id="fromUnit" onchange="convertUnits()">
                        <option value="m">Meters</option>
                        <option value="cm">Centimeters</option>
                        <option value="ft">Feet</option>
                        <option value="in">Inches</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="number" class="form-input" id="toValue" placeholder="To" readonly>
                    <select class="form-select" id="toUnit" onchange="convertUnits()">
                        <option value="m">Meters</option>
                        <option value="cm">Centimeters</option>
                        <option value="ft">Feet</option>
                        <option value="in">Inches</option>
                    </select>
                </div>
            </div>

            <!-- Word Counter -->
            <div class="tool-widget">
                <h4 class="tool-title">
                    <i class="fas fa-file-word"></i>
                    Word Counter
                </h4>
                <textarea class="form-textarea" id="wordCountText" placeholder="Paste your text here..." oninput="updateWordCount()"></textarea>
                <div style="display: flex; justify-content: space-between; margin-top: 0.5rem; font-size: 0.9rem; color: var(--text-secondary);">
                    <div>Words: <span id="wordCount">0</span></div>
                    <div>Characters: <span id="charCount">0</span></div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/dashboard.js"></script>
</body>
</html>
                    </select>
                </div>
            </div>

            <!-- Word Counter -->
            <div class="tool-widget">
                <h4 class="tool-title">
                    <i class="fas fa-file-word"></i>
                    Word Counter
                </h4>
                <textarea class="form-textarea" id="wordCountText" placeholder="Paste your text here..." oninput="updateWordCount()"></textarea>
                <div style="display: flex; justify-content: space-between; margin-top: 0.5rem; font-size: 0.9rem; color: var(--text-secondary);">
                    <div>Words: <span id="wordCount">0</span></div>
                    <div>Characters: <span id="charCount">0</span></div>
                </div>
            </div>

            <!-- QR Code Generator -->
            <div class="tool-widget">
                <h4 class="tool-title">
                    <i class="fas fa-qrcode"></i>
                    QR Generator
                </h4>
                <div class="form-group">
                    <input type="text" class="form-input" id="qrText" placeholder="Enter text or URL">
                    <button class="btn" onclick="generateQR()" style="margin-top: 0.5rem; width: 100%;">Generate QR</button>
                </div>
                <div id="qrResult" style="text-align: center; margin-top: 1rem; min-height: 150px; display: flex; align-items: center; justify-content: center; background: var(--bg-primary); border-radius: 8px; border: 1px solid var(--border-color);">
                    <span style="color: var(--text-secondary);">QR code will appear here</span>
                </div>
            </div>

            <!-- Clipboard History -->
            <div class="tool-widget">
                <h4 class="tool-title">
                    <i class="fas fa-clipboard-list"></i>
                    Clipboard History
                </h4>
                <div class="clipboard-list" id="clipboardList">
                    <div class="clipboard-item" style="padding: 0.5rem; background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 4px; margin-bottom: 0.5rem; font-size: 0.9rem; cursor: pointer;" onclick="copyToClipboard(this)">
                        Sample copied text...
                    </div>
                </div>
                <button class="btn secondary" onclick="clearClipboard()" style="width: 100%; margin-top: 0.5rem;">Clear History</button>
            </div>
        </div>
    </div>

    <!-- Wallpaper Modal -->
    <div class="modal" id="wallpaperModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
        <div class="modal-content" style="background: var(--bg-primary); border-radius: 12px; padding: 2rem; max-width: 600px; width: 90%; max-height: 80vh; overflow-y: auto;">
            <div class="modal-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <h3>Choose Wallpaper</h3>
                <button class="modal-close" onclick="closeWallpaperModal()" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: var(--text-secondary);">&times;</button>
            </div>
            <div class="modal-body">
                <div class="wallpaper-upload" style="margin-bottom: 1rem;">
                    <input type="file" id="wallpaperUpload" accept="image/*" onchange="uploadWallpaper()" style="display: none;">
                    <label for="wallpaperUpload" class="btn">Upload New Wallpaper</label>
                </div>
                <div class="wallpaper-grid" id="wallpaperGrid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 1rem;">
                    <div style="grid-column: 1/-1; padding: 1rem; text-align: center; background: var(--bg-tertiary); border-radius: 8px; cursor: pointer;" onclick="setWallpaper('')">Remove Wallpaper</div>
                    <div style="aspect-ratio: 16/9; background: linear-gradient(45deg, #ff6b6b, #4ecdc4); border-radius: 8px; cursor: pointer;" onclick="setWallpaper('data:image/svg+xml,<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 100 100&quot;><defs><linearGradient id=&quot;grad&quot; x1=&quot;0%&quot; y1=&quot;0%&quot; x2=&quot;100%&quot; y2=&quot;100%&quot;><stop offset=&quot;0%&quot; style=&quot;stop-color:%23ff6b6b&quot;/><stop offset=&quot;100%&quot; style=&quot;stop-color:%234ecdc4&quot;/></linearGradient></defs><rect width=&quot;100&quot; height=&quot;100&quot; fill=&quot;url(%23grad)&quot;/></svg>')"></div>
                    <div style="aspect-ratio: 16/9; background: linear-gradient(45deg, #667eea, #764ba2); border-radius: 8px; cursor: pointer;" onclick="setWallpaper('data:image/svg+xml,<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 100 100&quot;><defs><linearGradient id=&quot;grad2&quot; x1=&quot;0%&quot; y1=&quot;0%&quot; x2=&quot;100%&quot; y2=&quot;100%&quot;><stop offset=&quot;0%&quot; style=&quot;stop-color:%23667eea&quot;/><stop offset=&quot;100%&quot; style=&quot;stop-color:%23764ba2&quot;/></linearGradient></defs><rect width=&quot;100&quot; height=&quot;100&quot; fill=&quot;url(%23grad2)&quot;/></svg>')"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/dashboard.js"></script>
</body>
</html>
            const input = document.getElementById('todoInput');
            const text = input.value.trim();
            if (!text) return;

            const todoList = document.getElementById('todoList');
            const todoItem = document.createElement('div');
            todoItem.className = 'todo-item';
            todoItem.innerHTML = `
                <input type="checkbox" class="todo-checkbox">
                <span class="todo-text">${text}</span>
                <button class="todo-delete" onclick="deleteTask(this)">×</button>
            `;
            todoList.appendChild(todoItem);
            input.value = '';
        }

        function deleteTask(button) {
            button.parentElement.remove();
        }

        // Calculator functionality
        let calcExpression = '';
        let lastResult = false;

        function appendToCalc(value) {
            if (lastResult && !isNaN(value)) {
                calcExpression = '';
                lastResult = false;
            }
            calcExpression += value;
            document.getElementById('calcDisplay').textContent = calcExpression || '0';
        }

        function clearCalc() {
            calcExpression = '';
            document.getElementById('calcDisplay').textContent = '0';
            lastResult = false;
        }

        function deleteLast() {
            calcExpression = calcExpression.slice(0, -1);
            document.getElementById('calcDisplay').textContent = calcExpression || '0';
            lastResult = false;
        }

        function calculate() {
            try {
                const result = eval(calcExpression.replace(/×/g, '*').replace(/÷/g, '/'));
                document.getElementById('calcDisplay').textContent = result;
                calcExpression = result.toString();
                lastResult = true;
            } catch (error) {
                document.getElementById('calcDisplay').textContent = 'Error';
                calcExpression = '';
            }
        }

        // Unit converter
        const conversions = {
            length: {
                m: 1, cm: 100, ft: 3.28084, in: 39.3701
            },
            weight: {
                kg: 1, g: 1000, lb: 2.20462, oz: 35.274
            }
        };

        function updateUnitOptions() {
            const type = document.getElementById('unitType').value;
            const fromUnit = document.getElementById('fromUnit');
            const toUnit = document.getElementById('toUnit');
            
            let options = '';
            if (type === 'length') {
                options = '<option value="m">Meters</option><option value="cm">Centimeters</option><option value="ft">Feet</option><option value="in">Inches</option>';
            } else if (type === 'weight') {
                options = '<option value="kg">Kilograms</option><option value="g">Grams</option><option value="lb">Pounds</option><option value="oz">Ounces</option>';
            }
            
            fromUnit.innerHTML = options;
            toUnit.innerHTML = options;
        }

        function convertUnits() {
            const value = parseFloat(document.getElementById('fromValue').value);
            const fromUnit = document.getElementById('fromUnit').value;
            const toUnit = document.getElementById('toUnit').value;
            const type = document.getElementById('unitType').value;
            
            if (isNaN(value)) return;
            
            const fromFactor = conversions[type][fromUnit];
            const toFactor = conversions[type][toUnit];
            const result = value / fromFactor * toFactor;
            
            document.getElementById('toValue').value = result.toFixed(6);
        }

        // Word counter
        function updateWordCount() {
            const text = document.getElementById('wordCountText').value;
            const words = text.trim() ? text.trim().split(/\s+/).length : 0;
            const chars = text.length;
            
            document.getElementById('wordCount').textContent = words;
            document.getElementById('charCount').textContent = chars;
        }

        // Enter key for todo input
        document.getElementById('todoInput').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') addTodo();
        });

        // Initialize
        updateTimerDisplay();
        updateUnitOptions();
    </script>
</body>
</html>
