// Вспомогательные функции Composition API
export const useDebounce = (fn, delay) => {
    let timeoutId;
    return (...args) => {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => fn.apply(this, args), delay);
    };
};

export const formatDate = (date) => {
    return new Date(date).toLocaleDateString('ru-RU');
};