import os, sys

f = open(sys.argv[1], 'r')

T = int(f.readline())

def next(ary, start):
    j = start
    l = len(ary)
    ret = start - 1
    while j < l and ary[j]:
        ret = j
        j += 1
    return ret

for t in range(T):
    n, k = map(int, f.readline().strip().split(' '))
    a, b, c, r = map(int, f.readline().strip().split(' '))

    m = [0] * (4 * k)
    s = [0] * (k+1)
    m[0] = a
    if m[0] <= k:
        s[m[0]] = 1
    for i in xrange(1, k):
        m[i] = (b * m[i-1] + c) % r
        if m[i] < k+1:
            s[m[i]] += 1

#    print m
#    print s
    p = next(s, 0)

    m[k] = p + 1
    p = next(s, p+2)

    for i in xrange(k+1, n):
        if m[i-k-1] > p or s[m[i-k-1]] > 1:
            m[i] = p + 1
            if m[i-k-1] <= k:
                s[m[i-k-1]] -= 1
            s[m[i]] += 1
            p = next(s, p+2)
        else:
            m[i] = m[i-k-1]
        if p == k:
            break

    if p != k:
        print 'Case #%d: %d' % (t+1, m[n-1])
    else:
        print 'Case #%d: %d' % (t+1, m[i-k + (n-i+k+k) % (k+1)])

