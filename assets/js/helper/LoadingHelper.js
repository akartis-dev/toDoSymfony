/**
 * @Author <Akartis>
 *
 * Do it with love
 */
export default class LoadingHelper {
    static showLoading() {
        globalLoading.style.display = 'block'
    }

    static hideLoading() {
        globalLoading.style.display = 'none'
    }
}
