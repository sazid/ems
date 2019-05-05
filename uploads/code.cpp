#include <bits/stdc++.h>
using namespace std;

int main() {
    ios::sync_with_stdio(0);
    cin.tie(0);

    int n;
    cin >> n;
    vector<int> v(n);
    for (int& x : v) cin >> x;

	std::vector<int> len;
	int c = 1;
    for (int i = 1; i < n; ++i)
    {
    	if (v[i] == v[i-1]) ++c;
    	else {
    		len.push_back(c);
    		c = 1;
    	}
    }
    len.push_back(c);

    // for (int i : len) {
    // 	cout << i << endl;
    // }

    int mx = INT_MIN;
    for (int i = 1; i < len.size(); ++i) {
    	mx = max(mx, min(len[i], len[i-1]));
    }

    cout << mx*2 << endl;

    return 0;
}
