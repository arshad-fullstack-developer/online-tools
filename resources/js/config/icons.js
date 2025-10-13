/**
 * Centralized Icon Map Configuration
 * Maps icon names to emoji icons used throughout the application
 */

export const iconMap = {
    // Text & String Tools
    'type': '📝',
    'text': '🔤',
    'braces': '{}',
    'binary': '01',
    
    // Date & Time Tools
    'calendar': '📅',
    'calendar-range': '📆',
    
    // Finance Tools
    'dollar-sign': '💰',
    'coins': '💰',
    'percent': '%',
    'calculator': '🧮',
    'trending-up': '📈',
    'chart': '📊',
    
    // Developer Tools
    'code': '💻',
    'cpu': '🤖',
    'link': '🔗',
    'key': '🔑',
    'map': '🗺️',
    
    // Health & Fitness Tools
    'activity': '💪',
    'heart': '❤️',
    'scale': '⚖️',
    'fire': '🔥',
    'droplet': '💧',
    'body': '🧍',
    'health': '🏥',
    'cake': '🎂',
    
    // Design Tools
    'palette': '🎨',
    'color': '🎨',
};

/**
 * Get category icon with fallback
 * @param {string} icon - Icon name
 * @returns {string} - Emoji icon or default
 */
export const getCategoryIcon = (icon) => iconMap[icon] || '🛠️';

/**
 * Get tool icon with fallback
 * @param {string} icon - Icon name
 * @returns {string} - Emoji icon or default
 */
export const getToolIcon = (icon) => iconMap[icon] || '⚙️';
