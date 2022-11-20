#include<iostream>
using namespace std;

class cc {
    protected:
        int milk;
    public:
        void setmilk(int milk) {
            this->milk = milk;
        }
        int getmilk() {
            return milk;
        }
};

class cc1 : public cc {
    public:
        this = setmilk(10);
        
};

int main() {
    cc1 a;
    cout << a.getmilk();

}