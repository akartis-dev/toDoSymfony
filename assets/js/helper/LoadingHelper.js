/**
 * @Author <Akartis>
 *
 * Do it with love
 */
export default class LoadingHelper {
    static showLoading() {
        globalLoading.removeAttribute('style')
    }

    static hideLoading() {
        globalLoading.style.display = 'none'
    }
}
